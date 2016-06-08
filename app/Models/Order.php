<?php

namespace App\Models;

use App\Constants\AnalyzerConstant;
use App\Constants\AppConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Werashop\Post\EmsPost;

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
 * @property string $post_type
 * @property string $post_no
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereWxOutTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereWxTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereAddressId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCashPayment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCashPaymentCalculated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereBeansPayment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereBeansPaymentCalculated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePostFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePostType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePostNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereOrderStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereUpdatedAt($value)
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
            \BeanRecharger::executeConsume($this->customer, $this->total_price - $this->post_fee - $this->min_cash_price_without_post_fee);
            $this->beans_payment = $this->beans_payment_calculated;
//            $this->setPostNo(); //先拿掉了
            $this->updateStatistics();
            $this->status()->associate($next);
            return $this->save();
        }
        return false;
    }

    /**
     *
     */
    protected function updateStatistics()
    {
        foreach ($this->commodities()->get(['id'])->pluck('id') as $commodity_id) {
            \Analyzer::updateCommodityStatistics($this->customer_id, $commodity_id);
            \Analyzer::updateBasicStatistics($this->customer_id, AnalyzerConstant::CUSTOMER_COMMODITY);
            \EnterpriseAnalyzer::updateCommodityStatistics($commodity_id);
        }

        \Analyzer::updateBasicStatistics($this->customer_id, AnalyzerConstant::CUSTOMER_ORDER);
        \Analyzer::updateBasicStatistics($this->customer_id, AnalyzerConstant::CUSTOMER_MONEY_COST, $this->cash_payment);
        \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_ORDER);
        \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_COMMODITY, $this->commodities()->count());
        \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_INCOME, $this->cash_payment);
        \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_BEAN, $this->beans_payment);
    }

    /**
     * @return $this
     */
    public function calculate()
    {
        $cash_payment_calculated_without_post_fee = \BeanRecharger::calculateConsume($this->customer, $this->total_price - $this->post_fee - $this->min_cash_price_without_post_fee);

        $this->cash_payment_calculated = $cash_payment_calculated_without_post_fee + $this->post_fee + $this->min_cash_price_without_post_fee;
        $this->beans_payment_calculated = $this->total_price - $cash_payment_calculated_without_post_fee - $this->post_fee - $this->min_cash_price_without_post_fee;

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
        $this->post_fee = $post_fee;

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
        $this->increaseMinCashPrice(floatval($commodity->min_cash_price * $amount));
        return $this;
    }

    /**
     * @param array $items
     * @return $this
     */
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
        $this->wx_out_trade_no = md5($this->id . microtime());
        return $this;
    }

    /**
     * @param Customer $customer
     * @param Address $address
     * @return $this
     */
    public function initWithCustomerAndAddress(Customer $customer, Address $address){
        $this->bindCustomer($customer)->bindAddress($address)->addWechatOuttradeno();

        return $this;
    }

    /**
     * @return string
     */
    public function queryForDetailPage()
    {
        return static::where('id', $this->id)->with(['commodities', 'address'=> function ($query) {
            $query->withTrashed();
        }])->first()->toJson();
    }

    /**
     * @return $this
     */
    public function setPostNo() {
        $post = new EmsPost();

        $this->update(['post_no' => $post->getMailNo()]);
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public static function getPaidOrdersWithRelated()
    {
        return Order::where('order_status_id', '>', 1)->with(['customer', 'commodities' => function ($query) {
            $query->withTrashed();
        }, 'address' => function ($query) {
            $query->withTrashed();
        }])->orderBy('created_at', 'desc');
    }

    public function toOrderMessageString()
    {
        return '订单ID: '. $this->id . '; 支付金额: ' . $this->cash_payment. ' 已下单, 请尽快处理';
    }

    private function increaseMinCashPrice($floatval)
    {
        $this->min_cash_price_without_post_fee += $floatval;
        return $this;
    }
}