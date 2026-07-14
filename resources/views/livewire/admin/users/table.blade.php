<div>
    <div class="panel-head">
        <h2>Gestão de Usuários</h2>
        <button class="btn" wire:click="openCentralModal('admin.users.form', {'id': null })">Novo Usuário</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th class="text-center">CPF</th>
                    <th>Telefone</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" width="175px">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($response->users as $itemUser)
                <tr>
                    <td>{{$itemUser['name']}}</td>
                    <td>{{formatCPFCNPJ($itemUser['taxpayer_registration']) ?? 'S/C'}}</td>
                    <td>{{formatPhone($itemUser['phone'])}}</td>
                    <td class="text-center">
                        <x-badge text="{{$itemUser['statusLabel']}}" color="{{$itemUser['statusColor']}}"></x-badge>
                    </td>

                    <td class="actions">
                        <x-button sm text="Editar" color="orange"  wire:click="openCentralModal('admin.users.form', {'id': {{$itemUser['id']}} })"/>
                        <x-button sm text="Bloquear" color="red" wire:click="confirmDelete({{$itemUser['id']}})"/>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->users->links()}}
    </div>

</div>
