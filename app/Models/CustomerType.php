<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerType
 *
 * @package App\Models
 * @mixin \Eloquent
 * @property integer $id
 * @property string $type_en 用户类型-英
 * @property string $type_ch 用户类型-中
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerType whereTypeEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerType whereTypeCh($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerType whereUpdatedAt($value)
 */
class CustomerType extends Model
{
    protected $table = 'customer_types';

    public function customers()
    {
        return $this->hasMany('App\Models\Customer', 'type_id');
    }
}
