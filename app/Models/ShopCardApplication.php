<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShopCardApplication
 * @package App\Models
 * @mixin \Eloquent
 */
class ShopCardApplication extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }
}
