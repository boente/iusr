<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected static ?string $breadcrumb = 'Structure';

    public function getTitle(): string|Htmlable
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit')
                ->url(fn () => route('filament.admin.resources.courses.edit', $this->record)),
        ];
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(static::getResource()::viewForm(
                $this->makeForm()
                    ->operation('edit')
                    ->model($this->getRecord())
                    ->statePath($this->getFormStatePath())
                    ->columns($this->hasInlineLabels() ? 1 : 2)
                    ->inlineLabel($this->hasInlineLabels()),
            )),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }
}
