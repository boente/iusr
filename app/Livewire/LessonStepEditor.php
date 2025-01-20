<?php

namespace App\Livewire;

use App\Executors\Judge0;
use App\Filament\Forms\Components\CodeMirror;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class LessonStepEditor extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Model $record = null;

    public ?array $data = [];

    public ?bool $correct = false;

    public function mount()
    {
        $this->form->fill($this->record->only([
            'content',
            'code',
            'solution',
        ]));
    }

    public function execute()
    {
        $this->data['output'] = Judge0::execute($this->data['code'], $this->record->language_id);
        $this->check();
    }

    public function check()
    {
        $code = $this->data['code'];
        $solution = $this->data['solution'];
        $this->correct = Str::contains($code, $solution);
    }

    public function copy()
    {
        $this->data['solution'] = $this->data['output']['output'] ?? null;
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
                CodeMirror::make('code'),
                CodeMirror::make('solution')
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
        $this->record->update(Arr::except($this->data, ['output']));

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
