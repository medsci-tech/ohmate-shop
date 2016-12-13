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

    // protected $hidden = ['focus_count', 'register_count', 'questionnaire_count'];
    protected $appends = ['focus_count', 'register_count', 'questionnaire_count'];

    /**
     * @var array
     */
    public $timestamps = ['created_at', 'updated_at', 'auth_code_expired'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo | DoctorLevel
     */
    public function level()
    {
        return $this->belongsTo(DoctorLevel::class, 'level_id');
    }

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
		\Log::info('hongbao---reason'.\Cache::has($this->getCacheArticleBeanFeedKey()) );
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
        $currentTime =time();
        $diffTime = strtotime(date('Y-m-d',strtotime('+1 day'))) - $currentTime;
        $minutes = round($diffTime/60);

        if (!\Cache::has($this->getCacheArticleBeanFeedKey())) {
            \Cache::put($this->getCacheArticleBeanFeedKey(), 1, $minutes);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Eloquent
     */
    public function yikangQuestionnaire()
    {
        return $this->hasOne(YikangQuestionnaire::class);
    }

    public function doctorType()
    {
        $info = $this->information()->first();
        if ($info) {
            return $info->type;
        }
        
        return 'C';
    }

    /**
     * @return bool
     */
    public function hasPurchesedOneSale()
    {
        return !! Order::where('customer_id', $this->id)->where('special_sale', '=', '1元专区')->where('order_status_id', '>', 1)->count();
    }

    public function getFocusCountAttribute()
    {
        $key = 'focus_count_' . $this->id;
        if (!request()->has('force_search')) {
            return 0;
        }   
        $result = \Cache::remember($key, 60, function() {
            return Customer::where('referrer_id', $this->id)->count();
        });

        return $result;
    }

    public function getRegisterCountAttribute()
    {
        $key = 'register_count_' . $this->id;

        if (!request()->has('force_search')) {
            return 0;
        }   
        $result = \Cache::remember($key, 60, function() {
            return Customer::where('referrer_id', $this->id)->where('is_registered', 1)->count();
        });

        return $result;
    }

    public function getQuestionnaireCountAttribute()
    {
        $key = 'questionnaire_count_' . $this->id;

        if (!request()->has('force_search')) {
            return 0;
        }

//        $result = \Cache::remember($key, 60, function() {
//            return Customer::where('referrer_id', $this->id)->has('yikangQuestionnaire')->count();
//        });
        $result = Customer::where('referrer_id', $this->id)->has('SubscribeQuestionnaire')->count();

        return $result;
    }
}
