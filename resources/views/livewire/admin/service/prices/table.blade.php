<div>
    <section id="servicos" class="page-section active">
        <div class="panel">

            <div class="panel-head">
            <h2>Tipos de Serviços</h2>
            <button class="btn" wire:click="openSlide('admin.service.prices.form', {'type_id': {{$type_id}} }, 2)">Novo Serviço</button>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th class="text-center" width="160px" >Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($response->prices as $itemService)
                    <tr>
                        <td>
                            <div class="flex flex-col items-start">
                                <p>{{$itemService['name']}}</p>
                                <p class="text-xs">{{$itemService['description']}}</p>
                            </div>

                        </td>

                        <td>{{formatMoney($itemService['price'])}}</td>
                        <td class="actions">
                            <x-button xs text="Editar" color="orange"  wire:click="openSlide('admin.service.prices.form', {'id': {{$itemService['id']}} }, 2)"/>
                            <x-button xs text="Apagar" color="red" wire:click="confirmDelete({{$itemService['id']}})"/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding-top: 15px;">
            {{$response->prices->links()}}
        </div>

        </div>
    </section>
</div>
