<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property float $total_price
 * @property integer $order_status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\OrderStatus $status
 * @property integer $customer_id
 */
class Order extends Model
{
    protected $guarded = [];

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

    public function commodities()
    {
        return $this->belongsToMany(Commodity::class)->withPivot(['amount']);
    }

    public function addCommodity(Commodity $commodity)
    {
        $this->comm
    }
}
