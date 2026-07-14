<div>


    <div class="grid">
        <div class="panel">
            @if($order)
            <div class="panel-head">
                <h2>Novo pedido recebido</h2>
                <x-badge text="{{$order['statusWasherLabel']}}" color="{{$order['statusWasherColor']}}"></x-badge>
            </div>

            <div class="order-card">
                <div class="order-head">
                    <div>
                        <h3>{{$order['service']['type']['name']}}</h3>
                        <p>Cliente: {{$order['user']['name']}}</p>
                    </div>
                    <div class="price">{{formatMoney($order['service']['price'])}}</div>
                </div>

                <div class="order-info">
                    <div class="info-box">
                        <span>Endereço</span>
                        <strong>{{$order['street']}} - {{$order['number']}} - {{$order['neighborhood']}}</strong>
                    </div>

                    <div class="info-box">
                        <span>Distância</span>
                        <strong>1,8 km de você</strong>
                    </div>

                    <div class="info-box">
                        <span>Tipo de lavagem</span>
                        <strong>{{$order['service']['name']}}</strong>
                    </div>

                    <div class="info-box">
                        <span>Veículo</span>
                        <strong>{{$order['vehicle']}}</strong>
                    </div>
                </div>

                <div class="actions">
                    @if($order['status_washer'] === 'accepted' || $order['status'] === 'service_finish')
                        <x-button color="sky" icon="check-badge" wire:click="changeStatus({{$order['id']}}, 'accepted')" disabled>Aceitar</x-button>
                    @else
                        <x-button color="sky" icon="check-badge" wire:click="changeStatus({{$order['id']}}, 'accepted')" >Aceitar</x-button>
                    @endif

                    @if($order['status'] === 'declined' || $order['status'] === 'service_finish')
                        <x-button color="red" icon="x-circle" wire:click="changeStatus({{$order['id']}}, 'declined')" disabled>Recusar</x-button>
                    @else
                        <x-button color="red" icon="x-circle" wire:click="changeStatus({{$order['id']}}, 'declined')">Recusar</x-button>
                    @endif
                </div>
            </div>
            @else
                <div class="panel-head">
                    <h2>Sem novos pedidos no momento...</h2>
{{--                    <x-badge text="{{$order['statusWasherLabel']}}" color="{{$order['statusWasherColor']}}"></x-badge>--}}
                </div>
            @endif
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2>Disponibilidade</h2>
            </div>

            <div class="list">
                <div class="list-item">
                    <div>
                        <strong>Status atual</strong>
                        <span id="availabilityText">Disponível para pedidos</span>
                    </div>
                    <div class="percent">Online</div>
                </div>

                <div class="list-item">
                    <div>
                        <strong>Área de atuação</strong>
                        <span>Belém, Ananindeua e Marituba</span>
                    </div>
                    <div class="percent">3 áreas</div>
                </div>

                <div class="list-item">
                    <div>
                        <strong>Tempo médio</strong>
                        <span>Chegada até o cliente</span>
                    </div>
                    <div class="percent">12 min</div>
                </div>
            </div>
        </div>
    </div>
</div>
