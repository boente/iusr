<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Textarea;

class CodeMirror extends Textarea
{
    protected string $view = 'filament.components.code-mirror';

    protected string|Closure|null $language = null;
    protected string|Closure|null $solution = null;

    protected bool|Closure $isExecutable = false;

    public function language(string|Closure|null $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function solution(string|Closure|null $solution): static
    {
        $this->solution = $solution;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->evaluate($this->language);
    }

    public function getSolution(): ?string
    {
        return $this->evaluate($this->solution);
    }

    public function executable(bool|Closure $condition = true): static
    {
        $this->isExecutable = $condition;

        return $this;
    }

    public function isExecutable(): bool
    {
        return (bool) $this->evaluate($this->isExecutable);
    }
}
