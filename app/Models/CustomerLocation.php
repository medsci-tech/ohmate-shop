<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLocation extends Model
{
    protected $table = 'customer_locations';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
