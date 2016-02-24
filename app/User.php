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
