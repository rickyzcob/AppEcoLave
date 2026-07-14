<div>
    <div class="panel-head">
        <h2>Tipos de Serviços</h2>
        <button class="btn" wire:click="openCentralModal('admin.service.form', {'id': null })">Novo Tipo de Serviço</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th class=" text-center" width="260px">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response->services as $itemService)
                <tr>
                    <td>{{$itemService['name']}}</td>
                    <td>{{$itemService['description']}}</td>
                    <td class="actions">
                        <x-button sm text="Serviços" color="sky"  wire:click="openSlide('admin.service.prices.table', {'id': {{$itemService['id']}} })"/>
                        <x-button sm text="Editar" color="orange"  wire:click="openCentralModal('admin.service.form', {'id': {{$itemService['id']}} })"/>
                        <x-button sm text="Apagar" color="red" wire:click="confirmDelete({{$itemService['id']}})"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->services->links()}}
    </div>

</div>
