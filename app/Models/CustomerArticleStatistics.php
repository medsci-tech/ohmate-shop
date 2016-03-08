<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerArticleStatistics
 *
 */
class CustomerArticleStatistics extends Model
{
    protected $table = 'customer_article_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
