<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    protected $table = 'article_types';

    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'type_id');
    }

}
