<?php

namespace App\Facades;

class Code
{
    public static function executor()
    {
        return app('code.executor');
    }

    public static function checker()
    {
        return app('code.checker');
    }
}
