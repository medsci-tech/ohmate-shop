<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/3/4
 * Time: 15:34
 */

namespace App\Werashop\Statistics\Daily;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\CustomerDailyStatistics;

class DailyAnalyzer
{

    public function updateDailyItemCount($user, $item)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
            ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            $daily = new CustomerDailyStatistics();
            $daily->customer_id     = $user;
            $daily->date   = Carbon::now()->toDateString();
            $daily->$item  = 0;
        } else {
            $daily->$item += 1;
        } /*else*/
        $daily->save();
    }

    public function getDailyItemCount($user, $item)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
            ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            return 0;
        } /*if>*/
        return $daily->$item;
    }

} /*class*/