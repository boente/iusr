<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Checker extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'checker';
    }
}
