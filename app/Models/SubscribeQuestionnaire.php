<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscribeQuestionnaire
 * @package App\Models
 * @mixin \Eloquent
 */
class SubscribeQuestionnaire extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
