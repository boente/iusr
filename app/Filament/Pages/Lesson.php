<?php

namespace App\Filament\Pages;

use App\Models\Lesson as LessonModel;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;

class Lesson extends Page
{
    #[Locked]
    public LessonModel $lesson;

    protected static string $layout = 'components.layout.blank';

    protected static string $view = 'filament.pages.lesson';

    protected static ?string $slug = 'courses/{course}/lessons/{lesson}';

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string|Htmlable
    {
        return $this->lesson->title;
    }

    public function getSubheading(): string|Htmlable|null
    {
        return strip_tags($this->lesson->description);
    }

    public function mountCanAuthorizeAccess(): void
    {
        Gate::authorize('view', $this->lesson);
    }
}
