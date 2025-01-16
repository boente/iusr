<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use App\Executors\Judge0;

class LessonStepEditor extends Component
{
    public ?Model $record = null;

    public ?string $code;

    public ?string $output;

    public function boot()
    {
        $this->code = $this->record->code;
    }

    public function execute()
    {
        $this->output = Judge0::execute($this->code);
    }

    public function render()
    {
        return view('livewire.lesson-step-editor');
    }
}
