<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Write Lesson';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
