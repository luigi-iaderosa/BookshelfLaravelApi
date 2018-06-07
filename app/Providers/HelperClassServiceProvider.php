<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\HelperClass;
class HelperClassServiceProvider extends ServiceProvider
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
        $this->app->singleton('helper',function(){
            return new HelperClass();
        });
    }
}
