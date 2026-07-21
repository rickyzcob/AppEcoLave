<div>


    <div class="grid">
        <div class="panel">
            @if($response->newOrder)
            <div class="panel-head">
                <h2>Novo pedido recebido</h2>
                <x-badge text="{{$response->newOrder['statusWasherLabel']}}" color="{{$response->newOrder['statusWasherColor']}}"></x-badge>
            </div>

            <div class="order-card">
                <div class="order-head">
                    <div>
                        <h3>{{$response->newOrder['service']['type']['name']}}</h3>
                        <p>Cliente: {{$response->newOrder['user']['name']}}</p>
                    </div>
                    <div class="price">{{formatMoney($response->newOrder['service']['price'])}}</div>
                </div>

                <div class="order-info">
                    <div class="info-box">
                        <span>Endereço</span>
                        <strong>{{$response->newOrder['street']}} - {{$response->newOrder['number']}} - {{$response->newOrder['neighborhood']}}</strong>
                    </div>

                    <div class="info-box">
                        <span>Distância</span>
                        <strong>1,8 km de você</strong>
                    </div>

                    <div class="info-box">
                        <span>Tipo de lavagem</span>
                        <strong>{{$response->newOrder['service']['name']}}</strong>
                        <span class="text-black"> Data : {{ formatDate($response->newOrder['date_schedule'])}} - Horario : {{formatTime($response->newOrder['hour_schedule'])}} {{$response->newOrder['weekDay']}}</span>

                    </div>

                    <div class="info-box">
                        <span>Veículo</span>
                        <strong>{{$response->newOrder['vehicle']}}</strong>
                    </div>
                </div>

                <div class="actions">
                    @if($response->newOrder['status_washer'] === 'accepted' || $response->newOrder['status'] === 'service_finish')
                        <x-button color="sky" icon="check-badge" wire:click="changeStatus({{$response->newOrder['id']}}, 'accepted')" disabled>Aceitar</x-button>
                    @else
                        <x-button color="sky" icon="check-badge" wire:click="changeStatus({{$response->newOrder['id']}}, 'accepted')" >Aceitar</x-button>
                    @endif

                    @if($response->newOrder['status'] === 'declined' || $response->newOrder['status'] === 'service_finish')
                        <x-button color="red" icon="x-circle" wire:click="changeStatus({{$response->newOrder['id']}}, 'declined')" disabled>Recusar</x-button>
                    @else
                        <x-button color="red" icon="x-circle" wire:click="changeStatus({{$response->newOrder['id']}}, 'declined')">Recusar</x-button>
                    @endif
                </div>
            </div>
            @else
                <div class="panel-head">
                    <h2>Sem novos pedidos no momento...</h2>
{{--                    <x-badge text="{{$response->newOrder['statusWasherLabel']}}" color="{{$response->newOrder['statusWasherColor']}}"></x-badge>--}}
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
