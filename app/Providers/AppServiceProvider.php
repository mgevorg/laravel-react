<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Services\AuthService\Providers\AuthServiceProvider;
use Services\AuthService\Providers\RouteServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
