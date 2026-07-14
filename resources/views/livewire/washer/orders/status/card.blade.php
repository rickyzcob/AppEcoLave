<div>
    <section id="status" class="page-section active">
        <div class="panel">
            <div class="panel-head">
                <h2>Atualização de Status</h2>
                <span class="status andamento">Pedido #{{$order['reference']}}</span>
            </div>

            <div class="timeline">
                <div class="step @if($order['status'] === 'on_the_way') active @endif">
                    <div class="step-number">1</div>
                    <div>
                        <h3>A Caminho</h3>
                        <p>Profissional saiu para atendimento.</p>
                        @if($order['status'] === 'on_the_way')
                            <x-button color="blue" icon="rocket-launch" wire:click="updateStatus('on_the_way')" disabled>Marcar status</x-button>
                        @else
                            <x-button color="blue" icon="rocket-launch" wire:click="updateStatus('on_the_way')">Marcar status</x-button>
                        @endif
                    </div>
                </div>

                <div class="step @if($order['status'] === 'arrived_location') active @endif">
                    <div class="step-number">2</div>
                    <div>
                        <h3>Cheguei ao Local</h3>
                        <p>Profissional chegou no endereço do cliente.</p>
                        @if($order['status'] === 'arrived_location')
                            <x-button color="teal" icon="map-pin" wire:click="updateStatus('arrived_location')" disabled>Marcar status</x-button>
                        @else
                            <x-button color="teal" icon="map-pin" wire:click="updateStatus('arrived_location')">Marcar status</x-button>
                        @endif
                    </div>
                </div>

                <div class="step @if($order['status'] === 'service_started') active @endif">
                    <div class="step-number">3</div>
                    <div>
                        <h3>Serviço Iniciado</h3>
                        <p>Lavagem foi iniciada.</p>
                        @if($order['status'] === 'service_started')
                            <x-button color="violet" icon="arrow-right-circle" wire:click="updateStatus('service_started')" disabled>Marcar status</x-button>
                        @else
                            <x-button color="violet" icon="arrow-right-circle" wire:click="updateStatus('service_started')">Marcar status</x-button>
                        @endif
                    </div>
                </div>

                <div class="step @if($order['status'] === 'service_finish') active @endif">
                    <div class="step-number">4</div>
                    <div>
                        <h3>Serviço Finalizado</h3>
                        <p>Atendimento concluído com sucesso.</p>
                        @if($order['status'] === 'service_finish')
                            <x-button color="green" icon="check" wire:click="updateStatus('service_finish')" disabled>Finalizar serviço</x-button>
                        @else
                            <x-button color="green" icon="check" wire:click="updateStatus('service_finish')">Finalizar serviço</x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
