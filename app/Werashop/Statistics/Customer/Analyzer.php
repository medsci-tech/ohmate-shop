<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/3/4
 * Time: 15:19
 */

namespace App\Werashop\Statistics\Customer;

use Carbon\Carbon;
use App\Models\DoctorStatistics;
use App\Models\CustomerStatistics;
use App\Models\CustomerArticleStatistics;
use App\Models\CustomerCommodityStatistics;

class Analyzer
{

    public function updateBasicStatistics($userId, $item, $value = 1)
    {
        $statistics = CustomerStatistics::where('customer_id', $userId)->first();
        if (!$statistics) {
            $statistics = new CustomerStatistics();
            $statistics->customer_id = $userId;
        } /*if>*/
        $statistics->$item += $value;
        $statistics->save();
    }


    public function updateArticleStatistics($userId, $articleTypeId)
    {
        $statistics = CustomerArticleStatistics::where('customer_id', $userId)
                    ->where('article_type_id', $articleTypeId)->first();
        if (!$statistics) {
            $statistics = new CustomerArticleStatistics();
            $statistics->customer_id        = $userId;
            $statistics->article_type_id    = $articleTypeId;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }


    public function updateCommodityStatistics($userId, $commodityId)
    {
        $statistics = CustomerCommodityStatistics::where('customer_id', $userId)
                    ->where('commodity_id', $commodityId)->first();
        if (!$statistics) {
            $statistics = new CustomerCommodityStatistics();
            $statistics->customer_id        = $userId;
            $statistics->commodity_id       = $commodityId;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }

    public function updateDoctorStatistics(int $user, string $item)
    {
        $statistics = DoctorStatistics::where('customer_id', $user)->first();
        if (!$statistics) {
            $statistics = new DoctorStatistics();
            $statistics->customer_id    = $user;
        } /*if>*/
        $statistics->$item += 1;
        $statistics->save();
    }

} /*class>*/