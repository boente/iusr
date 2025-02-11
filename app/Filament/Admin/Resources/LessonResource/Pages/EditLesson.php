<?php

namespace App\Filament\Admin\Resources\LessonResource\Pages;

use App\Filament\Admin\Resources\LessonResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditLesson extends ViewRecord
{
    protected static string $resource = LessonResource::class;

    protected static string $layout = 'components.layout.blank';

    public function getTitle(): string|Htmlable
    {
        return 'Write Lesson';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
