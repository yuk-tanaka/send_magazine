<?php

namespace App\Services\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Magazine extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'magazine';
    }
}