<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2016/3/6
 * Time: 17:47
 */

namespace App\Werashop\Statistics\Enterprise;

use Carbon\Carbon;
use App\Models\EnterpriseBasicStatistics;
use App\Models\EnterpriseArticleStatistics;
use App\Models\EnterpriseCommodityStatistics;

/**
 * Class EnterpriseAnalyzer
 * @package App\Werashop\Statistics\Enterprise
 */
class EnterpriseAnalyzer
{
    /**
     * @param $item
     * @param int $value
     */
    public function updateBasic($item, $value = 1)
    {
        $daily = EnterpriseBasicStatistics::where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            $daily = new EnterpriseBasicStatistics();
            $daily->date = Carbon::now()->toDateString();
        } /*if>*/
        $daily->$item += $value;
        $daily->save();
    }

    /**
     * @param $articleType
     */
    public function updateArticleStatistics($articleTypeId)
    {
        $date = Carbon::now()->toDateString();

        $statistics = EnterpriseArticleStatistics::where('date', $date)
            ->where('article_type_id', $articleTypeId)->first();
        if (!$statistics) {
            $statistics = new EnterpriseArticleStatistics();
            $statistics->article_type_id    = $articleTypeId;
            $statistics->date   = $date;
            $statistics->count  = 1;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }

    /**
     * @param $commodity
     */
    public function updateCommodityStatistics($commodityId)
    {
        $date = Carbon::now()->toDateString();

        $statistics = EnterpriseCommodityStatistics::where('date', $date)
                    ->where('commodity_id', $commodityId)->first();
        if (!$statistics) {
            $statistics = new EnterpriseCommodityStatistics();
            $statistics->commodity_id       = $commodityId;
            $statistics->date   = $date;
            $statistics->count  = 1;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }


} /*class*/