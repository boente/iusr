<?php

namespace App\Checkers;

abstract class Checker
{
    abstract public function check(string $code, string $solution): bool;
}
