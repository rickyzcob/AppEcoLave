<div x-data x-init="$watch('$wire.openSlide', value => {
    if (value) $store.slides.open(1)
    })">
    <x-slide wire="openSlide" z-index="z-20" size="720" persistent>
        <div class="flex justify-end pb-3">
            <button class="rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlide(1)">
                <i class="material-icons-round p-2">cancel</i>
            </button>
        </div>
        @if($openSlide)
            <div @click.stop>
                @livewire($blade, $params)
            </div>
        @endif
    </x-slide>
</div>
