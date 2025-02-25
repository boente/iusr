<?php

namespace App\Filament\Pages;

use App\Models\Course;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $title = 'Courses';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $slug = '/';

    protected function getViewData(): array
    {
        return [
            'courses' => Course::all(),
        ];
    }
}
