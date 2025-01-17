<div class="fixed inset-0 bg-white z-50">
    <div class="grid grid-rows-[auto_1fr_auto] h-screen bg-gray-950 text-white">
        <div class="px-8 py-3.5 flex justify-between items-center border-b border-gray-800 bg-gray-900">
            <div class="flex gap-2 items-center">
                <span class="font-bold">{{ $record->chapter->course->title }}</span>
                <x-heroicon-o-chevron-right class="size-5 text-gray-600" />
                <span>{{ $record->chapter->title }}</span>
                <x-heroicon-o-chevron-right class="size-5 text-gray-600" />
                <span>{{ $record->title }}</span>
                @if ($this->step)
                    <x-heroicon-o-chevron-right class="size-5 text-gray-600" />
                    <span class="text-primary-500">Step {{ $this->step->number }}</span>
                @endif
            </div>
            <div class="flex gap-4">
                <x-filament::button
                    wire:click="backToCourse"
                    color="gray"
                    icon="heroicon-s-arrow-left">
                    Back to Course
                </x-filament::button>
                @if ($this->step)
                    <x-filament::button
                        wire:click="$dispatchTo('lesson-step-editor', 'save')"
                        icon="heroicon-s-check">
                        Save Step
                    </x-filament::button>
                @endif
            </div>
        </div>
        @if ($this->step)
            <livewire:lesson-step-editor
                wire:id="lesson-step-editor"
                :key="$this->step->id" 
                :record="$this->step" />
        @elseif (!$this->steps->count())
            <div class="p-4 m-auto">
                <x-filament::button
                    wire:click="addStep"
                    icon="heroicon-o-plus">
                    Create First Step
                </x-filament::button>                
            </div>
        @else
            <div></div>
        @endif
        <div class="px-8 py-3.5 border-t border-gray-800">
            @if ($this->steps->count())
                <div class="flex gap-4">
                    <x-filament::button
                        wire:click="addStep"
                        class="mr-auto"
                        color="gray"
                        icon="heroicon-s-plus">
                        Add Step
                    </x-filament::button>
                    <x-filament::button
                        wire:click="previousStep"
                        :disabled="$this->step->number === 1"
                        icon="heroicon-s-chevron-left"
                        color="gray">
                        Previous Step
                    </x-filament::button>
                    <x-filament::button
                        wire:click="nextStep"
                        icon="heroicon-s-chevron-right" icon-position="after"
                        :disabled="$this->step->number === $this->steps->count()"
                        color="gray">
                        Next Step
                    </x-filament::button>
                </div>
            @endif
        </div>
    </div>
</div>
