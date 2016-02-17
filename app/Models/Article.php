<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function type()
    {
        return $this->belongsTo('App\Models\ArticleType', 'type_id');
    }
}
