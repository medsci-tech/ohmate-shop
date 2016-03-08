<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DoctorStatistics
 *
 * @property integer $id
 * @property integer $customer_id 用户
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoctorStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoctorStatistics whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoctorStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DoctorStatistics whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DoctorStatistics extends Model
{
    protected $table = 'doctor_statistics';
}
