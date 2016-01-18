<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBean extends Model
{
    //
    protected $table = 'customer_beans';

    protected function rate()
    {
        return $this->belongsTo('App\Models\BeanRate', 'bean_rate_id');
    }
}
