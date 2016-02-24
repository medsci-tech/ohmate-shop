<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video
 *
 * @property integer $id
 * @property integer $type_id 类型
 * @property string $title 视频标题
 * @property string $thumbnail 视频缩略图
 * @property string $uri 视频uri
 * @property boolean $top top
 * @property integer $weight 权重
 * @property integer $count 阅读量
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\VideoType $type
 */
class Video extends Model
{
    protected $table = 'videos';

    public function type()
    {
        return $this->belongsTo('App\Models\VideoType', 'type_id');
    }
}
