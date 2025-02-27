<?php

namespace App\Livewire;

use App\Filament\Forms\Components\CodeMirror;
use App\Livewire\Concerns\ExecutesCode;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;

class LessonStepEditor extends Component implements HasForms
{
    use ExecutesCode;
    use InteractsWithForms;

    public ?Model $record = null;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill($this->record->only([
            'content',
            'code',
            'solution',
        ]));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\RichEditor::make('content')
                    ->toolbarButtons([
                        'h2',
                        'h3',
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                    ]),
                CodeMirror::make('code')
                    ->executable()
                    ->language($this->record->language->editor_language),
                CodeMirror::make('solution')
                    ->executable()
                    ->language($this->record->language->editor_language)
                    ->extraInputAttributes(['class' => 'text-sm font-mono !leading-5 !p-4']),
                Components\ViewField::make('output')
                    ->view('filament.components.code-output'),
            ])
            ->view('filament.components.layout.plain')
            ->statePath('data');
    }

    #[On('save')]
    public function save()
    {
        $this->authorize('update', $this->record);

        $this->record->update(Arr::except($this->data, 'output'));

        Notification::make()
            ->title('Step saved successfully')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.lesson-step-editor');
    }
}
