<?php

namespace App\Filament\Forms\Components;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Support\Enums\Alignment;
use Livewire\Component;

class CourseStructure
{
    public static function make(): Repeater
    {
        return static::makeChaptersRepeater();
    }

    protected static function makeChaptersRepeater()
    {
        return Repeater::make('chapters')
            ->relationship()
            ->orderColumn('order')
            ->label('Lessons')
            ->itemLabel(fn (array $state): string => $state['title'])
            ->addActionAlignment(Alignment::Start)
            ->addAction(fn ($action) => $action
                ->label('Add chapter')
                ->form(static::chapterForm())
                ->action(function (Course $record, array $data, Component $livewire) {
                    Chapter::create([...$data, 'course_id' => $record->id]);
                    $livewire->dispatch('course-structure-updated');
                }))
            ->deleteAction(fn ($action) => $action
                ->color('gray')
                ->requiresConfirmation()
                ->action(function (array $arguments, Repeater $component, Component $livewire) {
                    Chapter::find(static::itemId($component, $arguments))->delete();
                    $livewire->dispatch('course-structure-updated');
                }))
            ->extraItemActions([
                Action::make('edit')
                    ->icon('heroicon-s-pencil-square')
                    ->form(static::chapterForm())
                    ->fillForm(function (array $arguments, Repeater $component) {
                        return Chapter::find(static::itemId($component, $arguments))->toArray();
                    })
                    ->action(function (array $arguments, Repeater $component, Component $livewire, array $data): void {
                        Chapter::find(static::itemId($component, $arguments))->update($data);
                        $livewire->dispatch('course-structure-updated');
                    }),
            ])
            ->schema([
                Forms\Components\Hidden::make('id'),
                static::makeLessonsRepeater(),
            ]);
    }

    protected static function makeLessonsRepeater()
    {
        return Repeater::make('lessons')
            ->relationship()
            ->collapsed(true)
            ->collapsible(false)
            ->orderColumn('order')
            ->hiddenLabel(true)
            ->itemLabel(fn (array $state): string => $state['title'])
            ->addActionLabel('Add lesson')
            ->addActionAlignment(Alignment::Start)
            ->addAction(fn ($action) => $action
                ->form(static::lessonForm())
                ->action(function (Chapter $record, array $data, Component $livewire) {
                    Lesson::create([...$data, 'chapter_id' => $record->id]);
                    $livewire->dispatch('course-structure-updated');
                }))
            ->deleteAction(fn ($action) => $action
                ->color('gray')
                ->requiresConfirmation()
                ->action(function (array $arguments, Repeater $component, Component $livewire) {
                    Lesson::find(static::itemId($component, $arguments))->delete();
                    $livewire->dispatch('course-structure-updated');
                }))
            ->extraItemActions([
                Action::make('write')
                    ->icon('heroicon-s-code-bracket')
                    ->color('primary')
                    ->tooltip('Write')
                    ->url(fn (array $arguments, Repeater $component): string => route('filament.admin.resources.lessons.edit', ['record' => static::itemId($component, $arguments)])),
                Action::make('edit')
                    ->icon('heroicon-s-pencil-square')
                    ->tooltip('Edit')
                    ->form(static::lessonForm())
                    ->fillForm(function (array $arguments, Repeater $component) {
                        return Lesson::find(static::itemId($component, $arguments))->toArray();
                    })
                    ->action(function (array $arguments, Repeater $component, Component $livewire, array $data): void {
                        Lesson::find(static::itemId($component, $arguments))->update($data);
                        $livewire->dispatch('course-structure-updated');
                    }),
            ])
            ->schema([
                Forms\Components\Hidden::make('id'),
            ]);
    }

    protected static function chapterForm()
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required(),
        ];
    }

    protected static function lessonForm()
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required(),
            Forms\Components\TextInput::make('time_to_complete'),
        ];
    }

    protected static function lessonStepForm()
    {
        return [

        ];
    }

    protected static function itemId(Repeater $component, array $arguments)
    {
        return $component->getItemState($arguments['item'])['id'];
    }
}
