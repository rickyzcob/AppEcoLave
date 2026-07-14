<div class="relative">
    <x-slide wire="openSlide4xl" z-index="z-20" size="5xl" >
        <div class=" flex justify-end py-3">
            <div class="absolute -left-4 rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlide4xl()">
                <i class="material-icons-round  p-2">cancel</i>
            </div>
        </div>
        @if($openSlide4xl)
            <div>
                @livewire($blade, $params)
            </div>
        @endif
    </x-slide>
</div>
