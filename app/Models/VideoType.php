<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    protected $table = 'video_types';

    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'type_id');
    }
}
