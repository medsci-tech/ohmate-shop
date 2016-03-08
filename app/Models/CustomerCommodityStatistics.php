<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerCommodityStatistics
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property integer $commodity_id 商品类型
 * @property integer $count 计数
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerCommodityStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerCommodityStatistics whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerCommodityStatistics whereCommodityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerCommodityStatistics whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerCommodityStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerCommodityStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerCommodityStatistics extends Model
{
    protected $table = 'customer_commodity_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public static function getStatisticsByCustomerID($customerID)
    {
        $details = CustomerCommodityStatistics::where('customer_id', $customerID)->get();
        if($details) {
            $details = $details->toArray();
        } else {
            $details = [];
        }
        foreach($details as &$detail) {
            $detail['commodity'] = Commodity::find($detail['commodity_id'])->toArray();
        }
        return $details;
    }
}
