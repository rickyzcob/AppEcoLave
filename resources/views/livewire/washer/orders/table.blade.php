<div>
    <div class="panel-head">
        <h2>Gestão de Pedidos</h2>
        <button class="btn-light" wire:click="$refresh">Atualizar lista</button>
    </div>
    @foreach($response->orders as $itemOrder)
        <div class="order-card">
            <div class="order-head">
                <div>
                    <h3>Pedido #{{$itemOrder['reference']}}</h3>
                    <p>{{$itemOrder['street']}} - {{$itemOrder['number']}} </p>
                </div>

                <div class="">
                    <x-badge text="{{$itemOrder['statusLabel']}}" color="{{$itemOrder['statusColor']}}"></x-badge>
                </div>

                <div class="">
                    <x-badge text="{{$itemOrder['statusWasherLabel']}}" color="{{$itemOrder['statusWasherColor']}}"></x-badge>
                </div>
            </div>

            <div class="order-info">
                <div class="info-box">
                    <span>Serviço</span>
                    <strong>{{$itemOrder['service']['name']}}</strong>
                </div>
                <div class="info-box">
                    <span>Valor</span>
                    <strong>{{formatMoney($itemOrder['service']['price'])}}</strong>
                </div>
                <div class="info-box">
                    <span>Veículo</span>
                    <strong>{{$itemOrder['vehicle']}} - {{$itemOrder['vehicle_plate']}}</strong>
                </div>
                <div class="info-box">
                    <span>Cliente</span>
                    <strong>{{$itemOrder['user']['name']}}</strong>
                </div>
            </div>

            <div class="actions">
                @if($itemOrder['status_washer'] === 'accepted' || $itemOrder['status'] === 'service_finish')
                    <x-button color="sky" icon="check-badge" wire:click="changeStatus({{$itemOrder['id']}}, 'accepted')" disabled>Aceitar</x-button>
                @else
                    <x-button color="sky" icon="check-badge" wire:click="changeStatus({{$itemOrder['id']}}, 'accepted')" >Aceitar</x-button>
                @endif

                @if($itemOrder['status'] === 'declined' || $itemOrder['status'] === 'service_finish')
                    <x-button color="red" icon="x-circle" wire:click="changeStatus({{$itemOrder['id']}}, 'declined')" disabled>Recusar</x-button>
                @else
                    <x-button color="red" icon="x-circle" wire:click="changeStatus({{$itemOrder['id']}}, 'declined')">Recusar</x-button>
                @endif


                @if($itemOrder['status_washer'] === 'accepted' && $itemOrder['status'] !== 'service_finish')
                    <x-button class="secondary" icon="arrow-path-rounded-square" wire:click="openCentralModal('washer.orders.status.card', {'id': {{$itemOrder['id']}} })">Alterar Status</x-button>
                @elseif($itemOrder['status'] === 'service_finish')
                    <x-button class="secondary" icon="arrow-path-rounded-square" wire:click="openCentralModal('washer.orders.status.card', {'id': {{$itemOrder['id']}} })" disabled>Alterar Status</x-button>
                @endif
            </div>
        </div>
    @endforeach
</div>
