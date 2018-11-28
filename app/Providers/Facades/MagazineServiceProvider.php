<?php

namespace App\Providers\Facades;

use App\Services\Magazine\Magazine;
use Illuminate\Support\ServiceProvider;

class MagazineServiceProvider extends ServiceProvider
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
        $this->app->bind('magazine', Magazine::class);
    }
}
