<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerStatistics
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property integer $friend_count 好友数
 * @property integer $article_count 阅读数
 * @property integer $commodity_count 购买商品数
 * @property integer $order_count 订单数
 * @property float $money_cost 消费金额
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereFriendCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereArticleCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereCommodityCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereOrderCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereMoneyCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerStatistics extends Model
{
    protected $table = 'customer_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
