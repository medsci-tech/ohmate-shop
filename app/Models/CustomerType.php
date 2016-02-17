<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerType
 * @package App\Models
 * @mixin \Eloquent
 */
class CustomerType extends Model
{
    protected $table = 'customer_types';

    public function customers()
    {
        return $this->hasMany('App\Models\Customer', 'type_id');
    }
}
