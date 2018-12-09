<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\ProductServiceInterface',
            'App\Services\Implementation\ProductService'
        );
        $this->app->bind(
            'App\Services\UserServiceInterface',
            'App\Services\Implementation\UserService'
        );

        $this->app->bind(
            'App\Storage\ProductImageStorageInterface',
            'App\Storage\LaravelImpl\ProductImageStorage'
        );
        $this->app->bind(
            'App\Services\InvoiceServiceInterface',
            'App\Services\Implementation\InvoiceService'
        );
        $this->app->bind(
            'App\Services\InvoiceItemServiceInterface',
            'App\Services\Implementation\InvoiceItemService'
        );
        $this->app->bind(
            'App\Storage\UserAvatarStorageInterface',
            'App\Storage\LaravelImpl\UserAvatarStorage'
        );


    }
}
