<div x-data x-init="$watch('$wire.openSlide3', value => {
    if (value) $store.slides.open(3)
    })">
    <x-slide wire="openSlide3" z-index="z-40" size="680" persistent>
{{--        @if(auth()->user() && auth()->user()->role == 'admin')--}}
{{--            <div class="pb-14"></div>--}}
{{--        @endif--}}
        <div class="flex justify-end pb-2">
            <div class="rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlide(3)">
                <i class="material-icons-round  p-2">cancel</i>
            </div>
        </div>
        @if($openSlide3)
            <div>
                @livewire($blade, $params)
            </div>
        @endif
    </x-slide>
</div>
