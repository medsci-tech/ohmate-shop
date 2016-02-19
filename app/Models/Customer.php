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
 */
class Customer extends Model
{
    protected $table = 'customers';

    protected $guarded = [];

    public $timestamps = ['created_at', 'updated_at', 'auth_code_expired'];

    public function type()
    {
        return $this->belongsTo('App\Models\CustomerType', 'type_id');
    }

    public function beans()
    {
        return $this->hasMany('App\Models\CustomerBean', 'customer_id');
    }

    public function location()
    {
        return $this->hasOne('App\Models\CustomerLocation', 'customer_id');
    }

}
