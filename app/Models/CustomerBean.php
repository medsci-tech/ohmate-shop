<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerBean
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property integer $bean_rate_id 积分兑换规则
 * @property float $value 积分原始值
 * @property float $result result = rate * value
 * @property string $detail 积分备注
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereBeanRateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereResult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerBean whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerBean extends Model
{
    protected $table = 'customer_beans';

    protected function rate()
    {
        return $this->belongsTo('App\Models\BeanRate', 'bean_rate_id');
    }

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
