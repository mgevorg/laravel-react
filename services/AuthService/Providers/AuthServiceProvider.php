<?php

namespace Services\AuthService\Providers;

use Illuminate\Support\ServiceProvider;
use Services\AuthService\Contracts\AuthServiceInterface;
use Services\AuthService\ServiceCore\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Register services.
     */
    public function register() : void
    {
        // Binding by class/interface
        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        // Binding a custom name to the interface
        $this->app->bind(
            'services.auth-service',
            AuthServiceInterface::class
        );
    }
}
