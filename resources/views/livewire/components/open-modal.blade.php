<div>
    <x-modal wire="openModal" center
             x-on:close="$wire.hideCentralModal()">
        @if($openModal)
            <div>
                @livewire($blade, $params, key($params['id']))
            </div>
        @endif
    </x-modal>
</div>
