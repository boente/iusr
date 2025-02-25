<x-filament-panels::page>
    @foreach ($course->chapters()->get() as $chapter)
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">{{ $chapter->title }}</h2>
            <div class="grid grid-cols-3 gap-6">
                @foreach ($chapter->lessons as $lesson)
                    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-6 prose dark:prose-invert hover:dark:ring-primary-500">
                        <h3 class="mb-2">
                            {{ $lesson->title }}
                        </h3>
                        <div class="text-sm flex gap-3">
                            @if (true)
                                <div class="flex gap-1.5 items-center">
                                    <x-heroicon-s-check-circle class="size-5 text-primary-500" />
                                    Complete
                                </div>
                            @endif
                            @if ($lesson->time_to_complete)
                                <div class="flex gap-1.5 items-center">
                                    <x-heroicon-o-clock class="size-5 text-white" />
                                    {{ $lesson->time_to_complete }} minutes
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</x-filament-panels::page>
