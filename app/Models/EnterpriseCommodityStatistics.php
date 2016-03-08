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

    public function getTodayStatistics() {
        $statisticsDetals = $this::where('date', Carbon::yesterday()->format('Y-m-d'))->get()->toArray();
        foreach($statisticsDetals as &$details) {
            $details['commodity'] = Commodity::find($details['commodity_id'])->toArray();
        }
        return $statisticsDetals;
    }
}
