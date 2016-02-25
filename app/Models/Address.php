<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class Address extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

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
        $this->attributes['is_default'] = intval($b);
    }
}
