<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('captcha',function($attribute, $value, $parameters)
        {
            if(Session::get('Captcha')==$value)
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
