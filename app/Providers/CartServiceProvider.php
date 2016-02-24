<?php

namespace App\Providers;

use App\Werashop\Cart\SessionDrivenCart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
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
        $this->app->bind('cart', function ($app) {
            return SessionDrivenCart::getInstance();
        });
    }
}
