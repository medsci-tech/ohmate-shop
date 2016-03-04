<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerStatistics extends Model
{
    protected $table = 'customer_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
