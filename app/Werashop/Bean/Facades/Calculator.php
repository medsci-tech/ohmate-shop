<?php


namespace App\Werashop\Bean\Facades;


use Illuminate\Support\Facades\Facade;

class Calculator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bean_calculator';
    }
}