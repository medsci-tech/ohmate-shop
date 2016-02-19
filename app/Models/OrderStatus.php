<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderStatus
 *
 * @mixin \Eloquent
 */
class OrderStatus extends Model
{
    //

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function next()
    {
        return static::where('id', '>', $this->id)->first();
    }
}
