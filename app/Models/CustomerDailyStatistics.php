<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerDailyStatistics
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property string $date 日期
 * @property integer $article_count 阅读文章数
 * @property integer $share_count 转发文章数
 * @property integer $sign_in_count 签到数
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereArticleCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereShareCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereSignInCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CustomerDailyStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerDailyStatistics extends Model
{
    protected $table = 'customer_daily_statistics';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
