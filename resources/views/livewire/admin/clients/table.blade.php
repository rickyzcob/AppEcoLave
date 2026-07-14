<div>
    <div class="panel-head">
        <h2>Gestão de Clientes</h2>
        <button class="btn" wire:click="openCentralModal('admin.clients.form', {'id': null })">Novo Cliente</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th class="text-center">CPF</th>
                    <th>Telefone</th>
                    <th class="text-center">Status</th>
                    <th>Histórico</th>
                    <th class="text-center" width="175px">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($response->clients as $itemClient)
                <tr>
                    <td>{{$itemClient['name']}}</td>
                    <td>{{formatCPFCNPJ($itemClient['taxpayer_registration']) ?? 'S/C'}}</td>
                    <td>{{formatPhone($itemClient['phone'])}}</td>
                    <td class="text-center">
                        <x-badge text="{{$itemClient['statusLabel']}}" color="{{$itemClient['statusColor']}}"></x-badge>
                    </td>
                    <td>{{ $itemClient['orders_count'] }} pedidos</td>
                    <td class="actions">
                        <x-button sm text="Editar" color="orange"  wire:click="openCentralModal('admin.clients.form', {'id': {{$itemClient['id']}} })"/>
                        <x-button sm text="Bloquear" color="red" />
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->clients->links()}}
    </div>

</div>
