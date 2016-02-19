<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerLocation
 * @package App\Models
 * @mixin \Eloquent
 */
class CustomerLocation extends Model
{
    protected $table = 'customer_locations';

    protected function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
