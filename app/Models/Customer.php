<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';

    public function customerTypes()
    {
        return $this->belongsTo('App\Models\CustomerType');
    }

}
