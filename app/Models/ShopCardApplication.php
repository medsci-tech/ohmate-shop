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

    protected $guarded = [];
	
	protected $table = 'shop_card_applications';
	 
	public $timestamps = ['created_at', 'updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
