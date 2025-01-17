<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\CourseStructure;
use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                CourseStructure::make()
                    ->hidden(fn (string $operation) => $operation !== 'edit-structure'),
                Forms\Components\TextInput::make('title')
                    ->hidden(fn (string $operation) => $operation === 'edit-structure')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->hidden(fn (string $operation) => $operation === 'edit-structure')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('skill_level')
                    ->hidden(fn (string $operation) => $operation === 'edit-structure')
                    ->required(),
                Forms\Components\Select::make('language_id')
                    ->hidden(fn (string $operation) => $operation === 'edit-structure')
                    ->relationship('language', 'name')
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(fn ($record) => route('filament.admin.resources.courses.view', $record))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skill_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
