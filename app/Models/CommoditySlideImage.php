<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommoditySlideImage
 *
 * @property integer $id
 * @property integer $commodity_id
 * @property string $image_url
 * @property integer $priority
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommoditySlideImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommoditySlideImage whereCommodityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommoditySlideImage whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommoditySlideImage wherePriority($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommoditySlideImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CommoditySlideImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommoditySlideImage extends Model
{
    //
    protected $guarded = [];
}
