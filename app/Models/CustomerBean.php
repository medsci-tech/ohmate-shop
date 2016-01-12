<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBean extends Model
{
    //
    protected $table = 'customer_beans';

    protected function beanRate()
    {
        return $this->belongsTo('App\Models\BeanRate');
    }
}
