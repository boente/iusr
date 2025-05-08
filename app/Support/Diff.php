<?php

namespace App\Support;

use Jfcherng\Diff\Differ;
use Jfcherng\Diff\DiffHelper;

class Diff
{
    public static function sideBySide(string $code, string $solution): string
    {
        return DiffHelper::calculate($code, $solution, 'SideBySide', [
            'context' => Differ::CONTEXT_ALL,
            'ignoreCase' => true,
            'ignoreLineEnding' => true,
            'ignoreWhitespace' => true,
            'lengthLimit' => 2000,
            'fullContextIfIdentical' => true,
        ], [
            'detailLevel' => 'line',
            'language' => ['eng', [
                'old_version' => 'Code',
                'new_version' => 'Solution',
            ]],
            'lineNumbers' => true,
            'separateBlock' => true,
            'showHeader' => true,
            'spacesToNbsp' => false,
            'tabSize' => 4,
        ]);
    }
}