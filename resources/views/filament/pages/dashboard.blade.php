<x-filament-panels::page>
    <div class="grid grid-cols-3 gap-8">
        @foreach ($courses as $course)
            <a href="1"
                class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-6 prose dark:prose-invert hover:dark:ring-primary-500">
                <h2 class="mb-2">
                    {{ $course->title }}
                </h2>
                <div class="text-sm flex gap-3">
                    <div class="flex gap-1.5 items-center">
                        <x-heroicon-o-code-bracket class="size-5 text-white" />
                        {{ $course->language->name }}
                    </div>
                    <div class="flex gap-1.5 items-center">
                        <x-heroicon-o-tag class="size-5 text-white" />
                        {{ $course->topics->pluck('name')->join(',') }}
                    </div>
                    <div class="flex gap-1.5 items-center">
                        <x-heroicon-o-academic-cap class="size-5 text-white" />
                        {{ $course->level->name }}
                    </div>
                    @if ($course->time_to_complete)
                        <div class="flex gap-1.5 items-center">
                            <x-heroicon-o-clock class="size-5 text-white" />
                            {{ $course->time_to_complete }}
                        </div>
                    @endif
                </div>
                <div class="text-sm *:last:mb-0">
                    {!! $course->description !!}
                </div>
            </a>
        @endforeach
    </div>
</x-filament-panels::page>
