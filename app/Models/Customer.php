<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @package App\Models
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $type_id 用户类型ID
 * @property integer $referrer_id 1
 * @property string $phone personal telephone
 * @property boolean $is_registered is the user registered
 * @property string $auth_code sms auth code
 * @property string $auth_code_expired sms auth code expired
 * @property float $beans_total 迈豆总额
 * @property string $openid wechat open id
 * @property string $nickname wechat nick name
 * @property string $head_image_url wechat head img url
 * @property string $qr_code personal qr code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\CustomerType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerBean[] $beans
 * @property-read \App\Models\CustomerLocation $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerDailyArticle[] $dailyArticles
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    public $timestamps = ['created_at', 'updated_at', 'auth_code_expired'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CustomerType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function information()
    {
        return $this->hasOne(CustomerInformation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beans()
    {
        return $this->hasMany(CustomerBean::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(CustomerLocation::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cooperator() {
        return $this->belongsTo(Cooperator::class);
    }

    /**
     * @return mixed
     */
    public function paidOrders()
    {
        return $this->orders()->where('order_status_id', '>', 1);
    }

    /**
     * @return mixed
     */
    public function paidOrdersWithCommodities()
    {
        return $this->orders()->where('order_status_id', '>', 1)->with(['commodities' => function ($query) {
            $query->take(4);
        }]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @param int $num
     * @return bool
     */
    public function minusBean(int $num)
    {
        if ($this->beans_total > $num) {
            $this->beans_total -= $num;
            return $this->save();
        } else {
            return false;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statistics()
    {
        return $this->hasOne(CustomerStatistics::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function articleStatistics()
    {
        return $this->hasOne(CustomerArticleStatistics::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function commodityStatistics()
    {
        return $this->hasOne(CustomerCommodityStatistics::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dailyStatistics()
    {
        return $this->hasMany(CustomerDailyStatistics::class, 'customer_id');
    }


    /**
     * @param $month
     * @return mixed
     */
    public function monthBeans($month)
    {
        $date = explode('-', $month);
        $nextMonth = $date[0].'-0'.++$date[1];
        return $this->hasMany(CustomerBean::class, 'customer_id')->where('created_at', '>', $month)->where('created_at', '<', $nextMonth)->orderBy('created_at', 'desc')->get();
    }

    /**
     * 处理注册逻辑, 调用积分计算方法
     *
     * @return $this
     */
    public function register()
    {
        \BeanRecharger::register($this);
        return $this;
    }

    /**
     * @return \App\Models\Customer | null
     */
    public function getReferrer()
    {
        return self::find($this->referrer_id);
    }

    /**
     * @return bool
     */
    public function articleIndexNeedFeedBack()
    {
        if (!\Cache::has($this->getCacheArticleBeanFeedKey())) {
            return true;
        }

        if (\Cache::get($this->getCacheArticleBeanFeedKey()) >= 5) {
            return false;
        }

        return true;
    }

    /**
     * @return int|mixed
     */
    public function getArticleIndexFeedbackCount()
    {
        if (!\Cache::has($this->getCacheArticleBeanFeedKey())) {
            return 0;
        }

        return \Cache::get($this->getCacheArticleBeanFeedKey());
    }

    /**
     * @return mixed
     */
    public function readArticleIndex()
    {
        if (!\Cache::has($this->getCacheArticleBeanFeedKey())) {
            \Cache::put($this->getCacheArticleBeanFeedKey(), 1, 1440);
        } else if (\Cache::get($this->getCacheArticleBeanFeedKey()) < 5) {
            \Cache::increment($this->getCacheArticleBeanFeedKey());
        }

        return \Cache::get($this->getCacheArticleBeanFeedKey());
    }

    /**
     * @return string
     */
    protected function getCacheArticleBeanFeedKey()
    {
        return 'article_bean_feed_' . $this->id;
    }

    /**
     * @param $amount
     */
    public function minusBeansByHand($amount)
    {
        \BeanRecharger::executeTransferCash($this, $amount);
    }

    /**
     * @param $amount
     */
    public function buyCards($amount)
    {
        \BeanRecharger::executeTransferCash($this, $amount * 10000);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne | \Eloquent
     */
    public function subscribeQuestionnaire()
    {
        return $this->hasOne(SubscribeQuestionnaire::class);
    }
}
