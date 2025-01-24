@php
    $state = $getState();
    $correct = $getLivewire()->correct;
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="relative h-full">
    <div @class([
        'p-4 pb-20 text-sm font-mono leading-5 ring-1 ring-gray-950/10 dark:ring-white/20 rounded-lg overflow-auto transition',
        '!ring-success-500' => $correct,
    ])>
        <pre>{{ $state['output'] ?? null }}</pre>
        <pre class="text-red-600">{{ $state['error'] ?? null }}</pre>
    </div>
    <x-filament::icon-button
        :class="Arr::toCssClasses([
            '!absolute bottom-6 right-6 bg-success-500 !rounded-full !text-black transition',
            'opacity-0' => ! $correct,
        ])"
        icon="heroicon-s-check"
        color="gray">
    </x-filament::icon-button>
</x-dynamic-component>