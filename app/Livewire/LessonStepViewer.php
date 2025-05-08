<?php

namespace App\Livewire;

use App\Filament\Forms\Components\CodeMirror;
use App\Livewire\Concerns\ExecutesCode;
use App\Support\Diff;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LessonStepViewer extends Component implements HasForms
{
    use ExecutesCode;
    use InteractsWithForms;

    public ?Model $record = null;

    public ?array $data = [];

    public ?string $diff = null;

    public function mount()
    {
        $this->form->fill($this->record->only([
            'content',
            'code',
            'solution',
        ]));
    }

    public function passed()
    {
        $user = Auth::user();

        // if (! $this->record->users()->where('user_id', $user->id)->exists()) {
        //     $this->record->users()
        //         ->attach($user->id, ['completed_at' => now()]);
        // }
    }

    public function showSolution()
    {
        $this->diff = Diff::sideBySide($this->data['code'], $this->record->solution);

        $this->dispatch('open-modal', id: 'solution-modal');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\View::make('filament.components.content')
                    ->viewData([
                        'record' => $this->record,
                    ]),
                CodeMirror::make('code')
                    ->executable()
                    ->diff(fn () => $this->diff)
                    ->solution($this->record->solution)
                    ->language($this->record->language->editor_language),
                Components\ViewField::make('output')
                    ->view('filament.components.code-output'),
            ])
            ->view('filament.components.layout.plain')
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.lesson-step-viewer');
    }
}
