<div>
    <x-slide wire="openSlideMD" z-index="z-30" size="600" persistent>
        <div class="flex justify-end pb-3">
            <div class="rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlideMD()">
                <i class="material-icons-round  p-2">cancel</i>
            </div>
        </div>
        @if($openSlideMD)
            <div>
                @livewire($blade, $params)
            </div>
        @endif
    </x-slide>
</div>
