<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @mixin \Eloquent
 * @mixin \App\HasRoles
 * @property integer $id
 * @property integer $outer_id 用户在外部系统的ID
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $openid
 * @property string $nickname
 * @property string $portrait_url
 * @property string $qr_code_url 推广二维码图像地址
 * @property float $latitude
 * @property float $longitude
 * @property float $precision 精度
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereOuterId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePortraitUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereQrCodeUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePrecision($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
