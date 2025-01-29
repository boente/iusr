<?php

namespace App\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class LessonEditor extends Component
{
    public ?Model $record = null;

    #[Url(as: 'step', keep: true, history: true)]
    public $stepNumber;

    public function mount()
    {
        $this->stepNumber = $this->stepNumber ?? ($this->steps->count() ? 1 : null);
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

    public function addStep()
    {
        $this->authorize('create', LessonStep::class);

        unset($this->steps);
        unset($this->step);

        $this->record->steps()->create();
        $this->stepNumber = $this->steps->count();

        Notification::make()
            ->title('Step added successfully')
            ->success()
            ->send();
    }

    public function nextStep()
    {
        unset($this->step);

        $this->stepNumber = min($this->steps->count(), $this->stepNumber + 1);
    }

    public function previousStep()
    {
        unset($this->step);

        $this->stepNumber = max(0, $this->stepNumber - 1);
    }

    public function render()
    {
        return view('livewire.lesson-editor');
    }
}
