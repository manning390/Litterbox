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
        Validator::extend('hexcolor', function($attribute, $value, $parameters, $validator){
            $pattern = '/^#?[a-fA-F0-9]{3,6}$/';
            return (boolean) preg_match($pattern, $value);
        });
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
