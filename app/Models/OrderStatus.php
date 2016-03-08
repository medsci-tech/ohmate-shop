<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderStatus
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderStatus whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OrderStatus whereUpdatedAt($value)
 */
class OrderStatus extends Model
{
    protected $table = 'order_statuses';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function next()
    {
        return static::where('id', '>', $this->id)->first();
    }
}
