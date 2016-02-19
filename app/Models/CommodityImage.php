<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityImage extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commodity() {
        return $this->belongsTo(Commodity::class);
    }
}
