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
            $customer = $this->customer;
            \BeanRecharger::consume($customer->id, $this->total_price);

            $this->status()->associate($next);
            return $this->save();
        }
        return false;
    }

    /**
     * @return array
     */
    public function calculate()
    {
        return \BeanCalculator::calculate($this->total_price, $this->customer->beans_total);
    }


    /**
     * @return BelongsToMany
     */
    public function commodities()
    {
        return $this->belongsToMany(Commodity::class)->withPivot(['amount']);
    }


    /**
     * @param Commodity $commodity
     * @param int $amount
     * @return bool
     */
    public function addCommodity(Commodity $commodity, $amount)
    {
        return $this->commodities()->save($commodity, ['amount' => $amount]);
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
     * @param float $price
     * @return bool
     */
    public function increasePrice($price)
    {
        $this->total_price = $this->total_price + $price;
        return $this->save();
    }

    /**
     * @return bool
     */
    public function isPaid() {
        return $this->order_status_id >= 2;
    }
}
