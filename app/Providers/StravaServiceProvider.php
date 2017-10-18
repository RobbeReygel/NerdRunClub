<?php

namespace App\Providers;

use App\Api\Strava;
use Illuminate\Support\ServiceProvider;

class StravaServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Api\Strava', function ($app) {
            return new Strava();
        });
    }
}
