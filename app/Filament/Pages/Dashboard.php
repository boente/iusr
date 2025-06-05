<?php

namespace App\Filament\Pages;

use App\Models\Course;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Gate;

class Dashboard extends Page
{
    protected static ?string $title = 'Courses';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $slug = '/';

    public function mountCanAuthorizeAccess(): void
    {
        Gate::authorize('viewAny', Course::class);
    }

    protected function getViewData(): array
    {
        return [
            'courses' => Course::query()
                ->published()
                ->with('language')
                ->with('topics')
                ->with('level')
                ->with('lessons')
                ->get(),
        ];
    }
}
