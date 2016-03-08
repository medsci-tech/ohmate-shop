<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
/**
 * App\Models\EnterpriseArticleStatistics
 *
 * @property integer $id
 * @property string $date ����
 * @property integer $article_type_id ��������
 * @property integer $count ����
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseArticleStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseArticleStatistics whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseArticleStatistics whereArticleTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseArticleStatistics whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseArticleStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseArticleStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EnterpriseArticleStatistics extends Model
{
    protected $table = 'enterprise_article_statistics';

    public static function getTodayStatistics() {
        $statisticsDetals = EnterpriseArticleStatistics::where('date', Carbon::now()->format('Y-m-d'))->get();
        if($statisticsDetals) {
            $statisticsDetals = $statisticsDetals->toArray();
        } else {
            $statisticsDetals = [];
        }
        foreach($statisticsDetals as &$details) {
            $details['article_type'] = ArticleType::find($details['article_type_id'])->toArray();
        }
        return $statisticsDetals;
    }
}
