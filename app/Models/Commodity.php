<?php

namespace App\Models;

use App\Werashop\Cart\Buyable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Commodity
 *
 * @mixin \Eloquent
 */
class Commodity extends Model implements Buyable
{
    public function getPrice()
    {
        return $this->price;
    }

    public function getIdentifer()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImageSet()
    {
        return [];
        //TODO
    }
}
