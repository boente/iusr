<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\Attributes\Url;

class LessonEditor extends Component
{
    public ?Model $record = null;

    public ?Model $step = null;

    public function mount()
    {
        $this->step = $this->record->steps->first();
    }

    public function nextStep()
    {
        $this->step = $this->record->steps->where('order', '>', $this->step->id)->first();
    }
    
    public function previousStep()
    {
        $this->step = $this->record->steps->where('order', '<', $this->step->id)->last();
    }

    public function render()
    {
        return view('livewire.lesson-editor');
    }
}
