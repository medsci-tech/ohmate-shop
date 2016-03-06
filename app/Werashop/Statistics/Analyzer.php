<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/3/4
 * Time: 15:19
 */

namespace App\Werashop\Statistics;

use Carbon\Carbon;
use App\Models\DoctorStatistics;
use App\Models\CustomerStatistics;
use App\Models\CustomerArticleStatistics;
use App\Models\CustomerCommodityStatistics;

class Analyzer
{

    public function updateBasicStatistics($user, $item, $value = 1)
    {
        $year = Carbon::now()->year;

        $statistics = CustomerStatistics::where('customer_id', $user)
                    ->where('year', $year)->first();
        if (!$statistics) {
            $statistics = new CustomerStatistics();
            $statistics->customer_id    = $user;
            $statistics->year           = $year;
        } /*if>*/
        $statistics->$item += $value;
        $statistics->save();
    }

    public function updateArticleStatistics($user, $articleType)
    {
        $year = Carbon::now()->year;

        $statistics = CustomerArticleStatistics::where('customer_id', $user)
            ->where('year', $year)->where('article_type_id', $articleType->id)->first();
        if (!$statistics) {
            $statistics = new CustomerArticleStatistics();
            $statistics->customer_id        = $user;
            $statistics->article_type_id    = $articleType->id;
            $statistics->year   = $year;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }

    public function updateCommodityStatistics($user, $commodity)
    {
        $year = Carbon::now()->year;

        $statistics = CustomerCommodityStatistics::where('customer_id', $user)
            ->where('year', $year)->where('article_type_id', $commodity->id)->first();
        if (!$statistics) {
            $statistics = new CustomerCommodityStatistics();
            $statistics->customer_id        = $user;
            $statistics->commodity_id       = $commodity->id;
            $statistics->year   = $year;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }

    public function updateDoctorStatistics($user, $item)
    {
        $year = Carbon::now()->year;
        $statistics = DoctorStatistics::where('customer_id', $user)
            ->where('year', $year)->first();
        if (!$statistics) {
            $statistics = new DoctorStatistics();
            $statistics->customer_id    = $user;
            $statistics->year           = $year;
        } /*if>*/
        $statistics->$item += 1;
        $statistics->save();
    }

} /*class>*/