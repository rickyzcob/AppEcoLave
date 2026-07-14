<div class="relative">
    <x-slide wire="openSlide6xl" z-index="z-20" size="7xl" >
        <div class=" flex justify-end py-3">
            <div class="absolute -left-4 rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlide6xl()">
                <i class="material-icons-round  p-2">cancel</i>
            </div>
        </div>
            @if($openSlide6xl)
                <div class="">
                    @livewire($blade, $params)
                </div>
            @endif
    </x-slide>
</div>
