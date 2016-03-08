<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
/**
 * App\Models\EnterpriseArticleStatistics
 *
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
