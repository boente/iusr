<?php

namespace App\Executors;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

abstract class Executor
{
    abstract public static function execute(string $code, string $language): array;
}