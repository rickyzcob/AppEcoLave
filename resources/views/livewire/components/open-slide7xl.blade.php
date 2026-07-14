<div class="relative">
    <x-slide wire="openSlide7xl" z-index="z-20" size="full" >
        <div class="flex justify-end pb-3">
            <div class="rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlide7xl()">
                <i class="material-icons-round p-2">cancel</i>
            </div>
        </div>
        @if($openSlide7xl)
            <div class="">
                @livewire($blade, $params)
            </div>
        @endif
    </x-slide>
</div>
