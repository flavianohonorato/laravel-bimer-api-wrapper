<?php

namespace Wicool\BimerApi\Providers;

use Illuminate\Support\ServiceProvider;
use Wicool\BimerApi\Services\ApiClientAlterdata;

class BimerApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/bimer-api.php' => config_path('bimer-api.php'),
        ], 'config');
    }

    /**
     * Register.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('ApiClientAlterdata', function () {
            return new ApiClientAlterdata();
        });
    }
}
