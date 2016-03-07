<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2016/3/6
 * Time: 17:46
 */

namespace App\Werashop\Statistics\Enterprise\Facades;


use Illuminate\Support\Facades\Facade;

class EnterpriseAnalyzer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'enterprise_analyzer';
    }

}