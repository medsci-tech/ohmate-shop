<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/3/4
 * Time: 15:16
 */

namespace App\Werashop\Statistics\Facades;

use Illuminate\Support\Facades\Facade;

class Analyzer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'analyzer';
    }
}