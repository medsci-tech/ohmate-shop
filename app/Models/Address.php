<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Address
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $priority
 * @property integer $user_id
 * @property string $address
 * @property string $province
 * @property string $city
 * @property string $district
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $is_default
 * @property integer $customer_id
 * @property string $name
 * @property string $phone
 * @property string $postcode
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address wherePriority($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address wherePostcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereDistrict($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereDeletedAt($value)
 */
class Address extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * @param bool|string $b
     */
    public function setIsDefaultAttribute($b)
    {
        if (is_string($b)) {
            $b = ($b == 'true')? true : false;
        }

        $this->attributes['is_default'] = intval($b);
    }
}
