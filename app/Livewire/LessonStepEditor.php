<?php

namespace App\Livewire;

use App\Executors\Judge0;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Livewire\Component;

class LessonStepEditor extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Model $record = null;

    public ?string $code = null;

    public ?array $result = null;

    public ?array $data = [];

    public function mount()
    {
        $this->code = $this->record->code;
        $this->form->fill([
            'content' => $this->record->content,
        ]);
    }

    public function execute()
    {
        $this->result = Judge0::execute($this->code, $this->record->language_id);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\RichEditor::make('content')
                    ->hiddenLabel()
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
            ])
            ->view('components.layout.editor')
            ->statePath('data');
    }

    #[On('save')]
    public function save()
    {
        $this->record->update([
            ...$this->data,
            'code' => $this->code,
        ]);

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
