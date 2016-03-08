<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerArticleStatistics
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property integer $article_type_id 文章类型
 * @property integer $count 计数
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerArticleStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerArticleStatistics whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerArticleStatistics whereArticleTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerArticleStatistics whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerArticleStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerArticleStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
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
