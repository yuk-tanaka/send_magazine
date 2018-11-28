<?php

namespace App\Providers\Facades;

use App\Services\ImportCSV\ImportCSV;
use Illuminate\Support\ServiceProvider;

class ImportCSVServiceProvider extends ServiceProvider
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
        $this->app->bind('importCSV', ImportCSV::class);
    }
}
