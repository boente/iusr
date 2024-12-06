<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\LessonSteps;
use App\Filament\Resources\LessonResource\Pages;
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
                LessonSteps::make('steps')
                    ->relationship()
                    ->orderColumn('order')
                    ->itemLabel(fn (array $state): ?string => isset($state['order']) ? ('Step '.$state['order']) : null)
                    ->addActionLabel('Add step')
                    ->addActionAlignment(Alignment::Left)
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->required(),
                        Forms\Components\Textarea::make('code')
                            ->required(),
                    ])
                    ->columns(2),
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
