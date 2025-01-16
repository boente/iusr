<div class="grid grid-cols-[2fr_3fr_2fr] gap-4 p-4 *:min-w-0">
    <div class="p-4 text-sm prose text-gray-300">
        <h2 class="text-inherit text-lg font-semibold">Lorem Ipsum</h2>
        {!! $record->content !!}
    </div>
    <div class="text-sm relative bg-gray-950 rounded-lg text-white">
        <div
            wire:ignore
            x-data="codemirror(@js([
                'value' => $code,
            ]))"
            @class([
                'h-full w-full font-mono bg-transparent text-sm border border-primary-800 border-solid rounded-lg overflow-hidden',
                '*:h-full *:border-0 [&_.cm-content]:py-4 [&_.cm-content]:px-3 [&_.cm-editor]:bg-transparent',
            ])> 
        </div>
        <x-filament::button
            class="!absolute bottom-4 right-4"
            icon="heroicon-s-play"
            wire:click="execute">
            Run
        </x-filament::button>
    </div>
    <div class="p-4 text-sm font-mono bg-gray-950 rounded-lg">
        {{ $output }}
    </div>
</div>
