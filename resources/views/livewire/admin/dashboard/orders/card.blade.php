<div>
    <div class="bg-white  rounded-4xl border-solid p-6">
        <div class="panel-head">
            <h2>Pedidos recentes</h2>
            <a href="{{route('admin.orders')}}" class="btn-light" onclick="openPage('pedidos')">Ver todos</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
{{--                    <th>Pedido</th>--}}
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Profissional</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($response->orders as $itemOrder)
                    <tr>
                        <td>{{$itemOrder['user']['name']}}</td>
                        <td>{{$itemOrder['service']['name']}}</td>
                        <td>{{$itemOrder['washer']['name'] ?? 'S/c'}}</td>
                        <td><x-badge text="{{$itemOrder['statusWasherLabel']}}" color="{{$itemOrder['statusWasherColor']}}"></x-badge></td>
                        <td> {{formatMoney($itemOrder['service']['price'])}}</td>
                        <td class="text-center">
                            <x-button.circle sm icon="users" color="blue" wire:click="openCentralModal('admin.orders.manager.washer.form', {'id': {{$itemOrder['id']}} })"/>
                            <x-button.circle sm icon="pencil" color="orange"  wire:click="openCentralModal('admin.orders.manager.form', {'id': {{$itemOrder['id']}} })"/>
                        </td>
                    </tr>
                @endforeach

{{--                <tr>--}}
{{--                    <td>#1023</td>--}}
{{--                    <td>Ana Paula</td>--}}
{{--                    <td>Limpeza Profunda</td>--}}
{{--                    <td>Carlos Mendes</td>--}}
{{--                    <td><span class="status concluido">Concluído</span></td>--}}
{{--                    <td>R$ 119</td>--}}
{{--                    <td class="actions"><button>Ver</button><button>Recibo</button></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>#1022</td>--}}
{{--                    <td>Rafael Costa</td>--}}
{{--                    <td>Lavagem Simples</td>--}}
{{--                    <td>Pendente</td>--}}
{{--                    <td><span class="status pendente">Aguardando</span></td>--}}
{{--                    <td>R$ 49</td>--}}
{{--                    <td class="actions"><button onclick="openPage('distribuicao')">Distribuir</button><button>Cancelar</button></td>--}}
{{--                </tr>--}}
                </tbody>
            </table>
        </div>
    </div>
</div>
