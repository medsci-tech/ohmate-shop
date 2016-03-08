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
 * @property string $portrait
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CommoditySlideImage[] $slideImages
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity wherePortrait($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity whereIntroduction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Commodity whereUpdatedAt($value)
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slideImages()
    {
        return $this->hasMany(CommoditySlideImage::class);
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

    /**
     * @param $url
     */
    public function addImageUrl($url)
    {
        $image = new CommodityImage();
        $image->image_url = $url;
        $this->images()->save($image);
    }

    /**
     * @param $url
     */
    public function addSlideImageUrl($url)
    {
        $image = new CommoditySlideImage();
        $image->image_url = $url;
        $this->images()->save($image);
    }
}
