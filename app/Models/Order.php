<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Order
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property float $total_price
 * @property integer $order_status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\OrderStatus $status
 * @property integer $customer_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Commodity[] $commodities
 * @property integer $address_id
 * @property-read \App\Models\Address $address
 * @property string $wx_out_trade_no 商家订单号
 * @property string $wx_transaction_id 微信订单号
 * @property float $actual_payment 实付款,减去迈豆抵扣后的值
 * @property-read \App\Models\Customer $customer
 * @property float $cash_payment 实付款,减去迈豆抵扣后的值
 * @property float $cash_payment_calculated
 * @property float $beans_payment
 * @property float $beans_payment_calculated
 * @property float $post_fee
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    /**
     * @return bool
     */
    public function paid()
    {
        if ($this->status->name == 'paying' && $next = $this->status->next()) {
            \BeanRecharger::executeConsume($this->customer_id, $this->total_price - $this->post_fee);

            $this->status()->associate($next);
            return $this->save();
        }
        return false;
    }

    /**
     * @return $this
     */
    public function calculate()
    {
        $cash_payment_calculated_without_post_fee = \BeanRecharger::calculateConsume($this->customer_id, $this->total_price - $this->post_fee);

        $this->update([
            'cash_payment_calculated' => $cash_payment_calculated_without_post_fee + $this->post_fee,
            'beans_payment_calculated' => $this->total_price - $cash_payment_calculated_without_post_fee - $this->post_fee
        ]);

        return $this;
    }


    /**
     * @return BelongsToMany
     */
    public function commodities()
    {
        return $this->belongsToMany(Commodity::class)->withPivot(['amount']);
    }

    /**
     * @return bool
     */
    public function addPostFee()
    {
        $address = $this->address;
        $post_fee = floatval(\Helper::getPostFee($address));
        $this->update([
            'post_fee' => $post_fee
        ]);
        $this->increasePrice($post_fee);
        return $this;
    }


    /**
     * @param Commodity $commodity
     * @param $amount
     * @return $this
     */
    public function addCommodity(Commodity $commodity, $amount)
    {
        $this->commodities()->save($commodity, ['amount' => $amount]);
        $this->increasePrice(floatval($commodity->price * $amount));
        return $this;
    }

    public function addCommodities(array $items)
    {
        foreach ($items as $item) {
            $commodity = Commodity::findOrFail($item['id']);
            $this->addCommodity($commodity, $item['num']);
        }

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @param $price
     * @return $this
     */
    public function increasePrice($price)
    {
        $this->total_price = $this->total_price + $price;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPaid() {
        return $this->order_status_id >= 2;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function bindAddress(Address $address)
    {
        $this->address()->associate($address);
        $this->addPostFee();

        return $this;
    }

    /**
     * @param Customer $customer
     * @return $this
     */
    public function bindCustomer(Customer $customer)
    {
        $this->customer()->associate($customer);

        return $this;
    }

    /**
     * @return $this
     */
    public function addWechatOuttradeno()
    {
        $this->save();
        $this->update([
            'wx_out_trade_no' => md5($this->id . microtime())
        ]);

        return $this;
    }

    /**
     * @param Customer $customer
     * @param Address $address
     * @return $this
     */
    public function initWithCustomerAndAddress(Customer $customer, Address $address){
        $this->save();
        $this->bindCustomer($customer)->bindAddress($address)->addWechatOuttradeno();
        $this->save();

        return $this;
    }


}
