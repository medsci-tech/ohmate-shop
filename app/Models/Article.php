<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @property integer $id
 * @property integer $type_id 类型
 * @property string $title 文章标题
 * @property string $thumbnail 文章缩略图
 * @property string $uri 文章uri
 * @property boolean $head head
 * @property integer $weight 权重
 * @property integer $count 阅读量
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\ArticleType $type
 */
class Article extends Model
{
    protected $table = 'articles';

    public function type()
    {
        return $this->belongsTo('App\Models\ArticleType', 'type_id');
    }
}
