<?php

namespace App\Filament\Forms\Components;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater as Repeater;
use Filament\Support\Enums\Alignment;

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
                ->action(function (Course $record, array $data, Repeater $component) {
                    Chapter::create([...$data, 'course_id' => $record->id]);
                    static::refreshData($component);
                }))
            ->deleteAction(fn ($action) => $action
                ->color('gray')
                ->requiresConfirmation()
                ->action(function (array $arguments, Repeater $component) {
                    Chapter::find(static::itemId($component, $arguments))->delete();
                    static::refreshData($component);
                }))
            ->extraItemActions([
                Action::make('edit')
                    ->icon('heroicon-s-pencil-square')
                    ->form(static::chapterForm())
                    ->fillForm(function (array $arguments, Repeater $component) {
                        return Chapter::find(static::itemId($component, $arguments))->toArray();
                    })
                    ->action(function (array $arguments, Repeater $component, array $data): void {
                        Chapter::find(static::itemId($component, $arguments))->update($data);
                        static::refreshData($component);
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
                ->action(function (Chapter $record, array $data, Repeater $component) {
                    Lesson::create([...$data, 'chapter_id' => $record->id]);
                    static::refreshData($component);
                }))
            ->deleteAction(fn ($action) => $action
                ->color('gray')
                ->requiresConfirmation()
                ->action(function (array $arguments, Repeater $component) {
                    Lesson::find(static::itemId($component, $arguments))->delete();
                    static::refreshData($component);
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
                    ->action(function (array $arguments, Repeater $component, array $data): void {
                        Lesson::find(static::itemId($component, $arguments))->update($data);
                        static::refreshData($component);
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

    protected static function refreshData(Repeater $component)
    {
        $component->loadStateFromRelationships();
        foreach ($component->getChildComponentContainers() as $childComponentContainers) {
            foreach ($childComponentContainers->getComponents() as $childComponent) {
                if ($childComponent instanceof Repeater) {
                    static::refreshData($childComponent);
                }
            }
        }
    }
}
