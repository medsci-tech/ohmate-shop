<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/3/4
 * Time: 15:34
 */

namespace App\Werashop\Statistics;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\CustomerDailyStatistics;

class DailyAnalyzer
{

    public function updateDailyArticleCount($user)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
                ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            $daily = new CustomerDailyStatistics();
            $daily->customer_id     = $user;
            $daily->article_count   = 0;
            $daily->date = Carbon::now()->toDateString();
        } else {
            $daily->article_count += 1;
        }
        $daily->save();
    }

    public function getDailyArticleCount($user)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
                ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            return 0;
        } /*if>*/
        return $daily->article_count;
    }

    public function updateDailySignInCount($user)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
            ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            $daily = new CustomerDailyStatistics();
            $daily->customer_id     = $user;
            $daily->sign_in_count   = 0;
            $daily->date = Carbon::now()->toDateString();
        } else {
            $daily->sign_in_count += 1;
        }
        $daily->save();
    }

    public function getDailySignInCount($user)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
            ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            return 0;
        } /*if>*/
        return $daily->sign_in_count;
    }

    public function updateDailyShareCount($user)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
            ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            $daily = new CustomerDailyStatistics();
            $daily->customer_id     = $user;
            $daily->share_count     = 0;
            $daily->date = Carbon::now()->toDateString();
        } else {
            $daily->share_count += 1;
        }
        $daily->save();
    }

    public function getDailyShareCount($user)
    {
        $daily = CustomerDailyStatistics::where('customer_id', $user)
            ->where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {
            return 0;
        } /*if>*/
        return $daily->share_count;
    }

}