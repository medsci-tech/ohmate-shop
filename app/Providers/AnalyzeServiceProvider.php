<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Werashop\Statistics\Analyzer;
use App\Werashop\Statistics\DailyAnalyzer;
use App\Werashop\Statistics\EnterpriseAnalyzer;

class AnalyzeServiceProvider extends ServiceProvider
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
        $this->app->singleton('analyzer', function ($app) {
            return new Analyzer();
        });

        $this->app->singleton('daily_analyzer', function ($app) {
            return new DailyAnalyzer();
        });

        $this->app->singleton('enterprise_analyzer', function ($app) {
            return new EnterpriseAnalyzer();
        });

    }
}
