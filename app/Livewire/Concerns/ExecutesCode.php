<?php

namespace App\Livewire\Concerns;

use App\Facades\Code;

trait ExecutesCode
{
    public ?string $output = null;

    public ?string $error = null;

    public ?bool $correct = false;

    public function execute($name)
    {
        if (! in_array($name, ['code', 'solution'])) {
            abort(400);
        }

        $value = $this->data[$name];
        if (! $value) {
            return;
        }

        $this->fill(Code::executor()->execute($value, $this->record->language));

        $this->check();
    }

    public function check()
    {
        if (! $this->data['code'] || ! $this->data['solution']) {
            return;
        }

        $this->correct = Code::checker()
            ->check($this->data['code'], $this->data['solution']);

        $this->passed();
    }

    public function passed() {}
}
