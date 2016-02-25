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
 */
class Address extends Model
{
    protected $guarded = [];
}
