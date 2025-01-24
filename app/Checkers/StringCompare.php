<?php

namespace App\Checkers;

use Illuminate\Support\Str;

class StringCompare extends Checker
{
    public function check(string $code, string $solution): bool
    {
        $code = $this->simplify($code);
        $solution = $this->simplify($solution);

        return Str::contains($code, $solution);
    }

    protected function simplify(string $code): string
    {
        return Str::of($code)
            ->replaceMatches('/\s+/', '')
            ->lower()
            ->__toString();
    }
}
