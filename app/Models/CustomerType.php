<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    //
    protected $table = 'customer_types';

    public function customers() {
        return $this->hasMany('App\Models\Customer');
    }
}
