@php
    $output = $getLivewire()->output;
    $error = $getLivewire()->error;
    $correct = $getLivewire()->correct;
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="relative h-full">
    <div @class([
        'p-4 text-sm font-mono leading-5 ring-1 ring-gray-950/10 dark:ring-white/20 rounded-lg overflow-auto transition',
        '!ring-success-500' => isset($correct) && $correct,
        '!ring-danger-500' => isset($correct) && ! $correct,
    ])>
        <pre class="block">{{ $output }}</pre>
        <pre class="block text-red-600">{{ $error }}</pre>
    </div>
    <x-filament::icon-button
        :class="Arr::toCssClasses([
            '!absolute bottom-6 right-6 !rounded-full !text-white transition',
            'bg-success-500' => isset($correct) && $correct,
            'bg-danger-500' => isset($correct) && ! $correct,
            'opacity-0' => ! isset($correct),
        ])"
        :icon="match($correct) {
            true => 'heroicon-o-check',
            false => 'heroicon-o-x-mark',
            default => null,
        }"
        color="gray">
    </x-filament::icon-button>
</x-dynamic-component>