<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\LessonSteps;
use App\Filament\Resources\LessonResource\Pages;
use App\Livewire\Judge0;
use App\Livewire\LessonEditor;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Livewire::make(LessonEditor::class),
            ])
            ->columns(1);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
