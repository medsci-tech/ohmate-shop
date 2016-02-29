<?php

namespace App\Providers;

use App\Werashop\Bean\Calculator;
use App\Werashop\Bean\BeanRecharger;
use Illuminate\Support\ServiceProvider;

class BeanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bean_recharger', function ($app) {
            return new BeanRecharger();
        });

        $this->app->singleton('bean_calculator', function ($app) {
            return new Calculator();
        });
    }
}
