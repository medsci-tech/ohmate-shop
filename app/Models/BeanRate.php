<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeanRate extends Model
{
    //
    protected $table = 'bean_rates';

    public function customerBeans() {
        return $this->hasMany('App\Models\CustomerBean', 'bean_rate_id', 'id');
    }
}
