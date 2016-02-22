<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BeanRate
 *
 * @property integer $id
 * @property string $action_en 操作en
 * @property string $action_ch 操作ch
 * @property float $rate 操作<->积分兑换率
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerBean[] $beans
 */
class BeanRate extends Model
{
    protected $table = 'bean_rates';

    public function beans()
    {
        return $this->hasMany('App\Models\CustomerBean', 'bean_rate_id');
    }

}
