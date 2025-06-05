<?php

namespace App\Filament\Admin\Resources\CourseResource\Pages;

use App\Filament\Admin\Resources\CourseResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\On;

class ViewCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected static ?string $breadcrumb = 'Structure';

    #[On('course-structure-updated')]
    public function refreshCourseStructure(): void
    {
        $this->refreshFormData([]);
    }

    public function getTitle(): string|Htmlable
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit')
                ->url(fn () => route('filament.admin.resources.courses.edit', $this->record))
                ->visible(fn () => auth()->user()->can('update', $this->record)),
        ];
    }

    public function form(Form $form): Form
    {
        return $form->operation('edit-structure');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }
}
