<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerLocation
 *
 * @package App\Models
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $customer_id 用户
 * @property float $latitude 经度
 * @property float $longitude 维度
 * @property float $precision 精度
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class CustomerLocation extends Model
{
    protected $table = 'customer_locations';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
