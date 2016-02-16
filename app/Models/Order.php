<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * @return bool|Model
     */
    public function proceed()
    {
        if ($next = $this->status()->get()->next()) {
            return $this->status()->associate($next);
        }
        return false;
    }
}
