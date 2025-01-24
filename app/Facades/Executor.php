<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Executor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'executor';
    }
}
