<div>
    <div class="panel-head">
        <h2>Gestão dos Profissionais</h2>
        <button class="btn" wire:click="openCentralModal('admin.washers.form', {'id': null })">Novo Profissional</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Status</th>
                <th>Histórico</th>
                <th class="text-center" width="175px">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response->washers as $itemWasher)
                <tr>
                    <td>{{$itemWasher['name']}}</td>
                    <td>{{formatCPFCNPJ($itemWasher['taxpayer_registration']) ?? 'S/C'}}</td>
                    <td>{{formatPhone($itemWasher['phone'])}}</td>
                    <td>
                        <x-badge text="{{$itemWasher['statusLabel']}}" color="{{$itemWasher['statusColor']}}"></x-badge>
                    </td>
                    <td>{{ $itemWasher['orders_count'] }} pedidos</td>
                    <td class="actions">
                        <x-button sm text="Editar" color="orange"  wire:click="openCentralModal('admin.washers.form', {'id': {{$itemWasher['id']}} })"/>
                        <x-button sm text="Bloquear" color="red" />
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->washers->links()}}
    </div>

</div>
