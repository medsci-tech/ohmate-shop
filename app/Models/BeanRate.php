<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeanRate extends Model
{
    protected $table = 'bean_rates';

    public function beans()
    {
        return $this->hasMany('App\Models\CustomerBean', 'bean_rate_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'bean_rate_id', 'id');
    }

}
