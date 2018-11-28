<?php

namespace App\Services\Support\Facades;

use Illuminate\Support\Facades\Facade;

class ImportCSV extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'importCSV';
    }
}