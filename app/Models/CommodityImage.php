<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommodityImage
 *
 * @property integer $id
 * @property integer $commodity_id
 * @property string $image_url
 * @property integer $priority
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Commodity $commodity
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommodityImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommodityImage whereCommodityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommodityImage whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommodityImage wherePriority($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommodityImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommodityImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommodityImage extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commodity() {
        return $this->belongsTo(Commodity::class);
    }
}
