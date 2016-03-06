<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Werashop\Statistics\Enterprise\EnterpriseAnalyzer;

class EnterpriseAnalyzeServiceProvider extends ServiceProvider
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
        $this->app->singleton('enterprise_analyzer', function ($app) {
            return new EnterpriseAnalyzer();
        });
    }
}
