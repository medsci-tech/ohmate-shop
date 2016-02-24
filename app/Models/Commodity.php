<?php

namespace App\Models;

use App\Werashop\Cart\Buyable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Commodity
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $remark
 * @property string $introduction
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommodityImage[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 */
class Commodity extends Model implements Buyable
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(CommodityImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getIdentifer()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getImageSet()
    {
        return $this->images()->get()->toArray();
    }
}
