<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    public function beanRates()
    {
        $this->hasMany('App\Models\BeanRate', 'project_id', 'id');
    }

} /*class*/
