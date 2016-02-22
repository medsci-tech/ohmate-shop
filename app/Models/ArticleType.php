<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleType
 *
 * @property integer $id
 * @property string $type_en 文章类型-英
 * @property string $type_ch 文章类型-中
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 */
class ArticleType extends Model
{
    protected $table = 'article_types';

    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'type_id');
    }

}
