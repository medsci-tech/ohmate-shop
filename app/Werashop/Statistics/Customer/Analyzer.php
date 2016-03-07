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

    public function updateBasicStatistics(int $user, string $item, int $value = 1)
    {
        $statistics = CustomerStatistics::where('customer_id', $user)->first();
        if (!$statistics) {
            $statistics = new CustomerStatistics();
            $statistics->customer_id = $user;
        } /*if>*/
        $statistics->$item += $value;
        $statistics->save();
    }

    public function updateArticleStatistics(int $user, $articleType)
    {
        $statistics = CustomerArticleStatistics::where('customer_id', $user)
                    ->where('article_type_id', $articleType->id)->first();
        if (!$statistics) {
            $statistics = new CustomerArticleStatistics();
            $statistics->customer_id        = $user;
            $statistics->article_type_id    = $articleType->id;
            $statistics->count  = 0;
        } /*if>*/
        $statistics->count += 1;
        $statistics->save();
    }

    public function updateCommodityStatistics(int $user, $commodity)
    {
        $statistics = CustomerCommodityStatistics::where('customer_id', $user)
                    ->where('commodity_id', $commodity->id)->first();
        if (!$statistics) {
            $statistics = new CustomerCommodityStatistics();
            $statistics->customer_id        = $user;
            $statistics->commodity_id       = $commodity->id;
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