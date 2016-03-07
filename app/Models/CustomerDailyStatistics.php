<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDailyStatistics extends Model
{
    protected $table = 'customer_daily_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
