<?php

namespace App\Executors;

use App\Models\Language;

abstract class Executor
{
    abstract public function execute(string $code, Language $language): array;

    public function fields(): array
    {
        return [];
    }
}
