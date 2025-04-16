<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class LessonViewer extends Component
{
    public ?Model $record = null;

    #[Url(as: 'step', keep: true, history: true)]
    public $stepNumber;

    public function mount()
    {
        $this->stepNumber = $this->stepNumber
            ? $this->stepNumber
            : ($this->steps->count() ? 1 : null);
    }

    public function updatedStepNumber()
    {
        if (! $this->stepNumber && $this->steps->count()) {
            $this->stepNumber = 1;
        }
    }

    #[Computed]
    public function steps()
    {
        return $this->record->steps;
    }

    #[Computed]
    public function step()
    {
        return $this->stepNumber ? $this->steps->slice($this->stepNumber - 1, 1)->first() : null;
    }

    public function nextStep()
    {
        unset($this->step);

        $this->stepNumber = $this->stepNumber === $this->steps->count() ? 0 : $this->stepNumber + 1;
    }

    public function previousStep()
    {
        unset($this->step);

        $this->stepNumber = max(1, $this->stepNumber - 1);
    }

    public function render()
    {
        return view('livewire.lesson-viewer');
    }
}
