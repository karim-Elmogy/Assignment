<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\SystemUse\UserInterface',
            'App\Http\Repositories\SystemUse\UserRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\SystemUse\ServiceInterface',
            'App\Http\Repositories\SystemUse\ServiceRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\ProductInterface',
            'App\Http\Repositories\ProductRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\OrderInterface',
            'App\Http\Repositories\OrderRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\AuthInterface',
            'App\Http\Repositories\Api\AuthApiRepositoies'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\OrderInterface',
            'App\Http\Repositories\Api\OrderRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
