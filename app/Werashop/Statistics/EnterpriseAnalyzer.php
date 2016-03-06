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

class EnterpriseAnalyzer
{
    public function updateBasic() {
        $daily = EnterpriseBasicStatistics::where('date', Carbon::now()->toDateString())->first();
        if (!$daily) {

        }

    }

} /*class*/