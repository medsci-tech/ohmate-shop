<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDailyArticle extends Model
{
    protected $table = 'customer_daily_articles';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
