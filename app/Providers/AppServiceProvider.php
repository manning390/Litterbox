<?php

namespace App\Providers;

use Validator;
use App\Enums\Enum;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('enum', 'Enum@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Illuminate\Contracts\Hashing\Hasher::class, function (Application $app) {
            return $app['hash'];
        });
    }
}
