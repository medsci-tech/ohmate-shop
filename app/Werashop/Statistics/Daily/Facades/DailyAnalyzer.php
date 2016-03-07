<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/3/4
 * Time: 15:33
 */

namespace App\Werashop\Statistics\Daily\Facades;


use Illuminate\Support\Facades\Facade;

class DailyAnalyzer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'daily_analyzer';
    }
}