@php
    $statePath = $getStatePath();
    $state = $getState();
    $name = $getName();
    $isExecutable = $isExecutable();
    $diff = $getDiff();
    $language = $getLanguage();
    $solution = $getSolution();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="relative">
    <div
        wire:ignore
        x-data="codemirror(@js([
            'value' => $state,
            'language' => $language,
        ]))"
        x-on:input="$wire.set('{{ $statePath }}', $event.detail, false)"
        @class([
            'code-mirror block w-full rounded-lg overflow-hidden border-none bg-white text-base text-gray-950 shadow-sm outline-none ring-1 transition duration-75 placeholder:text-gray-400 focus-within:ring-2 disabled:bg-gray-50 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:bg-white/5 dark:text-white dark:placeholder:text-gray-500 dark:disabled:bg-transparent dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6',
            'ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500 dark:disabled:ring-white/10' => ! $errors->has($statePath),
            'ring-danger-600 focus-within:ring-danger-600 dark:ring-danger-500 dark:focus-within:ring-danger-500' => $errors->has($statePath),
            '[&_.cm-content]:border-0 [&_.cm-content]:pt-4 [&_.cm-content]:pb-20 [&_.cm-content]:px-3',
            '[&_.cm-editor]:bg-transparent',
            '[&_.cm-focused]:outline-none',
            '[&_.cm-gutters]:rounded-l-lg [&_.cm-gutters]:bg-gray-50 [&_.cm-gutters]:dark:bg-gray-950',
        ])> 
    </div>
    @if ($solution)
        <div class="!absolute bottom-6 left-10">
            <x-filament::modal width="6xl" :close-button="true" id="solution-modal">
                <x-slot name="heading">
                    Check Your Code
                </x-slot>
                <div @class([
                    'ring-1 ring-gray-950/10 dark:ring-white/20 rounded-lg overflow-hidden',
                ])>
                    {!! $diff !!}
                </div>
                <div class="flex justify-between gap-2">
                    <x-filament::button
                        wire:click="retrySolution"
                        icon="heroicon-o-arrow-left"
                        color="gray">
                        Retry
                    </x-filament::button>
                    <x-filament::button
                        wire:click="solveSolution"
                        icon="heroicon-o-light-bulb"
                        color="gray">
                        Solve
                    </x-filament::button>
                </div>
            </x-filament::modal>
            <x-filament::button
                wire:click="showSolution"
                outlined
                class="[&>svg]:!text-yellow-400"
                icon="heroicon-s-light-bulb"
                label-sr-only
                color="gray">
                Solution<
            </x-filament::button>
        </div>
    @endif
    @if ($isExecutable)
        <x-filament::button
            class="!absolute bottom-6 right-6"
            icon="heroicon-s-play"
            wire:click="execute('{{ $name }}')">
            Run
        </x-filament::button>
    @endif
</x-dynamic-component>
