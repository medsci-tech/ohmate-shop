<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnterpriseCommodityStatistics
 *
 */
class EnterpriseCommodityStatistics extends Model
{
    protected $table = 'enterprise_commodity_statistics';

    public static function getTodayStatistics() {
        $statisticsDetals = EnterpriseCommodityStatistics::where('date', Carbon::now()->format('Y-m-d'))->get();
        if($statisticsDetals) {
            $statisticsDetals = $statisticsDetals->toArray();
        } else {
            $statisticsDetals = [];
        }
        foreach($statisticsDetals as &$details) {
            $details['commodity'] = Commodity::find($details['commodity_id'])->toArray();
        }
        return $statisticsDetals;
    }
}
