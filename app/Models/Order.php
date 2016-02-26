<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Commodity[] $commodities
 * @property integer $address_id
 * @property-read \App\Models\Address $address
 */
class Order extends Model
{
    /**
     * @var array
     */
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


    /**
     * @return BelongsToMany
     */
    public function commodities()
    {
        return $this->belongsToMany(Commodity::class)->withPivot(['amount']);
    }


    /**
     * @param Commodity $commodity
     * @param int $amount
     * @return bool
     */
    public function addCommodity(Commodity $commodity, $amount)
    {
        return $this->commodities()->save($commodity, ['amount' => $amount]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @param float $price
     * @return bool
     */
    public function increasePrice($price)
    {
        $this->total_price = $this->total_price + $price;
        return $this->save();
    }
}
