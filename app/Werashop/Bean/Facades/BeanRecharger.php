<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/2/19
 * Time: 17:34
 */

namespace App\Werashop\Bean\Facades;

use Illuminate\Support\Facades\Facade;

class BeanRecharger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bean_recharger';
    }
}