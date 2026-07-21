<div>
    <div class="panel-head">
        <h2>Gestão de Pedidos</h2>
        <button class="btn" wire:click="openCentralModal('admin.orders.manager.form', {'id': null })">Novo Pedido</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Responsável</th>
                <th>Telefone</th>
                <th class="text-center">Status</th>
                <th class="text-center">Profissional</th>
                <th class="text-center" width="175px">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response->orders as $itemOrder)
                <tr>
                    <td>
                        <div class="flex flex-col items-start">
                            <h1>{{$itemOrder['user']['name']}}</h1>
                            <p class="text-xs uppercase">{{$itemOrder['vehicle']['name']}} - {{$itemOrder['vehicle']['plate']}}</p>
                        </div>
                    </td>

                    <td>{{$itemOrder['washer']['name'] ?? 'S/C'}}</td>

                    <td>{{formatPhone($itemOrder['user']['phone'])}}</td>

                    <td class="text-center">
                        <x-badge text="{{$itemOrder['statusLabel']}}" color="{{$itemOrder['statusColor']}}"></x-badge>
                    </td>

                    <td class="text-center">
                        <x-badge text="{{$itemOrder['statusWasherLabel']}}" color="{{$itemOrder['statusWasherColor']}}"></x-badge>
                    </td>

                    <td>
                        <div class="flex items-center justify-center gap-1">
                            @if($itemOrder['status'] === 'service_finish' && $itemOrder['status_washer'] !== 'finish')
                                <x-button.circle sm icon="check-circle" wire:click="confirmFinish({{$itemOrder['id']}})" color="red" color="green" />

                            @endif
                            @if($itemOrder['status_washer'] !== 'finish')
                                <x-button.circle sm icon="users" color="blue" wire:click="openCentralModal('admin.orders.manager.washer.form', {'id': {{$itemOrder['id']}} })"/>
                                <x-button.circle sm icon="pencil" color="orange"  wire:click="openCentralModal('admin.orders.manager.form', {'id': {{$itemOrder['id']}} })"/>
                                <x-button.circle sm icon="trash" wire:click="confirmCancel({{$itemOrder['id']}})" color="red" />
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->orders->links()}}
    </div>

</div>
