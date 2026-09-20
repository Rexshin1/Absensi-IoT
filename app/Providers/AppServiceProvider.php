<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Railway terminates TLS at its proxy. Force generated asset and route
        // URLs to HTTPS in production so browsers do not block them as mixed
        // content when APP_URL was previously stored with an http scheme.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
