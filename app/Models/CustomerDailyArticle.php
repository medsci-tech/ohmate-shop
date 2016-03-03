<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerDailyArticle
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property string $date 日期
 * @property float $value 单日学习获得迈豆总额
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class CustomerDailyArticle extends Model
{
    protected $table = 'customer_daily_articles';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
