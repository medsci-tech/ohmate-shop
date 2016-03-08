<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnterpriseCommodityStatistics
 *
 * @property integer $id
 * @property string $date ����
 * @property integer $commodity_id ��Ʒ����
 * @property integer $count ����
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseCommodityStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseCommodityStatistics whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseCommodityStatistics whereCommodityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseCommodityStatistics whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseCommodityStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EnterpriseCommodityStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EnterpriseCommodityStatistics extends Model
{
    protected $table = 'enterprise_commodity_statistics';

    public static function getTodayStatistics() {
        $statisticsDetals = EnterpriseCommodityStatistics::where('date', Carbon::yesterday()->format('Y-m-d'))->get();
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
