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

    public static function getStatisticsByCustomerID($customerID)
    {
        $details = CustomerArticleStatistics::where('customer_id', $customerID)->get();
        if($details) {
            $details = $details->toArray();
        } else {
            $details = [];
        }
        foreach($details as &$detail) {
            $detail['article_type'] = ArticleType::find($detail['article_type_id'])->toArray();
        }
        return $details;
    }
}
