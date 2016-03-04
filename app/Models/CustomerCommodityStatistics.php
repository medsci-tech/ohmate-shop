<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCommodityStatistics extends Model
{
    protected $table = 'customer_commodity_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
