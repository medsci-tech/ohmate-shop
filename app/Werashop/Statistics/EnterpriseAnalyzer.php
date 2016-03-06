<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2016/3/6
 * Time: 17:47
 */

namespace App\Werashop\Statistics;

use Carbon\Carbon;
use App\Models\EnterpriseBasicStatistics;
use App\Models\EnterpriseArticleStatistics;
use App\Models\EnterpriseCommodityStatistics;

class EnterpriseAnalyzer
{
    public function updateBasic($item, $value = 1)
    {
        $daily = EnterpriseBasicStatistics::where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            $daily = new EnterpriseBasicStatistics();
            $daily->date = Carbon::now()->toDateString();
        } /*if>*/
        $daily->$item = $value;
        $daily->save();
    }

    public function updateArticleStatistics($articleType)
    {
        $date = Carbon::now()->toDateString();

        $statistics = EnterpriseArticleStatistics::where('date', $date)
            ->where('article_type_id', $articleType->id)->first();
        if (!$statistics) {
            $statistics = new EnterpriseArticleStatistics();
            $statistics->article_type_id    = $articleType->id;
            $statistics->date   = $date;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }

    public function updateCommodityStatistics($commodity)
    {
        $date = Carbon::now()->toDateString();

        $statistics = EnterpriseCommodityStatistics::where('date', $date)
                    ->where('commodity_id', $commodity->id)->first();
        if (!$statistics) {
            $statistics = new EnterpriseCommodityStatistics();
            $statistics->commodity_id       = $commodity->id;
            $statistics->date   = $date;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }


} /*class*/