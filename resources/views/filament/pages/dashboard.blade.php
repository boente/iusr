@php
use App\Filament\Pages\Course;
@endphp

<x-filament-panels::page class="py-8">
    <div class="grid grid-cols-3 gap-6">
        @foreach ($courses as $course)
            <a href="{{ Course::getUrl(['course' => $course]) }}"
                class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-6 prose dark:prose-invert hover:dark:ring-primary-500 transition">
                <h2 class="mb-2">
                    {{ $course->title }}
                </h2>
                <div class="text-sm flex gap-3">
                    <div class="flex gap-1.5 items-center">
                        <x-heroicon-o-code-bracket class="size-5 dark:text-white" />
                        {{ $course->language->name }}
                    </div>
                    <div class="flex gap-1.5 items-center">
                        <x-heroicon-o-tag class="size-5 dark:text-white" />
                        {{ $course->topics->pluck('name')->join(',') }}
                    </div>
                    <div class="flex gap-1.5 items-center">
                        <x-heroicon-o-academic-cap class="size-5 dark:text-white" />
                        {{ $course->level->name }}
                    </div>
                    @if ($course->time_to_complete)
                        <div class="flex gap-1.5 items-center">
                            <x-heroicon-o-clock class="size-5 dark:text-white" />
                            {{ $course->time_to_complete }} hours
                        </div>
                    @endif
                </div>
                <div class="text-sm *:last:mb-0 line-clamp-4">
                    {!! $course->description !!}
                </div>
            </a>
        @endforeach
    </div>
</x-filament-panels::page>
