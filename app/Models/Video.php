<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    public function type()
    {
        return $this->belongsTo('App\Models\VideoType', 'type_id');
    }
}
