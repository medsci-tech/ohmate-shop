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
        $statisticsDetails = self::where('date', Carbon::now()->format('Y-m-d'))->get();
        if($statisticsDetails) {
            $statisticsDetails = $statisticsDetails->toArray();
        } else {
            $statisticsDetails = [];
        }
        foreach($statisticsDetails as &$details) {
            $details['commodity'] = Commodity::find($details['commodity_id'])->toArray();
        }
        return $statisticsDetails;
    }

    public static function getAllStatistics()
    {
        return self::select(\DB::raw('commodity_id, sum(count) as count'))->groupBy('commodity_id')->with('commodity')->get()->toArray();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commodity()
    {
        return $this->belongsTo(Commodity::class);
    }
}
