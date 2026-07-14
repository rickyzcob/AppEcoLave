<div x-data x-init="$watch('$wire.openSlide2', value => {
    if (value) $store.slides.open(2)
    })">
    <x-slide wire="openSlide2" z-index="z-30" size="700"  persistent >
        {{--        @if(auth()->user() && auth()->user()->role == 'admin')--}}
        {{--            <div class="pb-14"></div>--}}
        {{--        @endif--}}
        <div class="flex justify-end pb-2">
            <div class="rounded-full bg-gray-700 text-white cursor-pointer" wire:click="closeSlide(2)">
                <i class="material-icons-round  p-2">cancel</i>
            </div>
        </div>
        @if($openSlide2)
            <div @click.stop>
                @livewire($blade, $params)
            </div>
        @endif
    </x-slide>
</div>
