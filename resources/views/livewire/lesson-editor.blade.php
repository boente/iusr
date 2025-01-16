<div class="fixed inset-0 bg-white z-50">
    <div class="grid grid-rows-[auto_1fr] h-screen bg-gray-900 text-white">
        <div class="px-8 py-4 flex justify-between items-center border-b border-gray-800">
            <div class="flex gap-2 items-center">
                <span class="font-bold">Lesson {{ $record->order }}</span>
                <x-heroicon-o-chevron-right class="size-5 text-gray-600" />
                <span>Step {{ $step->order }}</span>
            </div>
            <div class="flex gap-2">
                <x-filament::button
                    wire:click="previousStep"
                    :disabled="$step->order === 1"
                    icon="heroicon-s-chevron-left"
                    size="sm">
                    Prev Step
                </x-filament::button>
                <x-filament::button
                    wire:click="nextStep"
                    icon="heroicon-s-chevron-right" icon-position="after"
                    :disabled="$step->order === $record->steps->count()"
                    size="sm">
                    Next Step
                </x-filament::button>
            </div>
        </div>
        <livewire:lesson-step-editor :record="$step" :key="$step->id" />
        <div></div>
    </div>
</div>
