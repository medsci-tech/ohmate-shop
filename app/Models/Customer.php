<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function type()
    {
        return $this->belongsTo('App\Models\CustomerType', 'type_id');
    }

    public function beans()
    {
        return $this->hasMany('App\Models\CustomerBean', 'customer_id');
    }

    public function location()
    {
        return $this->hasOne('App\Models\CustomerLocation', 'customer_id');
    }

}
