<div class="grid grid-cols-[1fr_2fr] grid-rows-[1fr_1fr_1fr] gap-4 py-4 px-8 *:min-w-0">
    <div class="text-sm prose dark:prose-invert row-span-3">
        {{ $this->form }}
    </div>
    <div class="text-sm relative bg-gray-900 rounded-lg text-white row-span-2">
        <div
            wire:ignore
            x-data="codemirror(@js([
                'value' => $code,
            ]))"
            x-on:input="$wire.set('code', $event.detail, false)"
            @class([
                'h-full w-full font-mono bg-transparent text-sm border border-gray-700 border-solid rounded-lg overflow-hidden',
                'focus-within:border-primary-500',
                '*:h-full *:border-0 [&_.cm-content]:py-4 [&_.cm-content]:px-3 [&_.cm-editor]:bg-transparent',
            ])> 
        </div>
        <x-filament::button
            class="!absolute bottom-6 right-6 text-xl"
            icon="heroicon-s-play"
            wire:click="execute">
            Run
        </x-filament::button>
    </div>
    <div class="p-4 text-sm font-mono border border-gray-800 rounded-lg overflow-auto">
        <pre>{{ $result['output'] ?? null }}</pre>
        <pre class="text-red-600">{{ $result['error'] ?? null }}</pre>
    </div>
</div>
