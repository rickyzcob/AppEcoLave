<div>
    <div class="panel-head">
        <h2>Gestão de Comissões dos Lavadores</h2>
        <button class="btn" wire:click="openCentralModal('admin.committees.form', {'id': null })">Nova Comissão</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th class="text-center">Porcentagem</th>
                <th class="text-center" width="175px">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response->committees as $ItemCommittee)
                <tr>
                    <td>{{$ItemCommittee['name']}}</td>
                    <td class="text-center">{{formatPercentage($ItemCommittee['value']) ?? 'S/C'}}</td>
                    <td class="actions">
                        <x-button sm text="Editar" color="orange"  wire:click="openCentralModal('admin.committees.form', {'id': {{$ItemCommittee['id']}} })"/>
                        <x-button sm text="Deletar" color="red" wire:click="confirmDelete({{$ItemCommittee['id']}})" />
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->committees->links()}}
    </div>

</div>
