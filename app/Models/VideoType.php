<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VideoType
 *
 * @property integer $id
 * @property string $type_en 视频类型-英
 * @property string $type_ch 视频类型-中
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Video[] $videos
 */
class VideoType extends Model
{
    protected $table = 'video_types';

    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'type_id');
    }
}
