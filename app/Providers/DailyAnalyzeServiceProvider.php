<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Werashop\Statistics\Daily\DailyAnalyzer;

class DailyAnalyzeServiceProvider extends ServiceProvider
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
        //
        $this->app->singleton('daily_analyzer', function ($app) {
            return new DailyAnalyzer();
        });

    }
}
