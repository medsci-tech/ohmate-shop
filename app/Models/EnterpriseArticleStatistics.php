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

    public function getTodayStatistics() {
        $statisticsDetals = $this::where('date', Carbon::yesterday()->format('Y-m-d'))->get()->toArray();
        foreach($statisticsDetals as &$details) {
            $details['article_type'] = ArticleType::find($details['article_type_id'])->toArray();
        }
        return $statisticsDetals;
    }
}
