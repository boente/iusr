<?php

namespace App\Filament\Pages;

use App\Models\Course as CourseModel;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\Locked;

class Course extends Page
{
    #[Locked]
    public CourseModel $course;

    protected static string $view = 'filament.pages.course';

    protected static ?string $slug = 'courses/{course}';

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string|Htmlable
    {
        return $this->course->title;
    }

    public function getSubheading(): string|Htmlable|null
    {
        return strip_tags($this->course->description);
    }
}
