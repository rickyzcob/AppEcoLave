<div>
    <div class="panel-head">
        <h2>Solicitações de saque</h2>
        <button class="btn" wire:click="openCentralModal('admin.financial.washer.withdrawal.form', {'id': null })" >Solicitar saque</button>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>

                <th >Valor</th>
                <th >Chave Pix</th>
                <th>Data Solicitação</th>
                <th class="text-center">Status</th>
                <th class="text-center" width="175px">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response->withdrawals as $itemWithdrawal)
                <tr>
                    <td>{{formatMoney($itemWithdrawal['amount'])}}</td>
                    <td>{{$itemWithdrawal['key_pix'] }}</td>
                    <td>{{ formatDateAndTime($itemWithdrawal['created_at']) }} </td>
                    <td class="text-center">
                        <x-badge text="{{$itemWithdrawal['statusLabel']}}" color="{{$itemWithdrawal['statusColor']}}"></x-badge>
                    </td>

                    <td class="actions">
                        <x-button sm text="Editar" color="orange"  wire:click="openCentralModal('admin.financial.washer.withdrawal.form', {'id': {{$itemWithdrawal['id']}} })"/>
                        @if($itemWithdrawal['status'] != 'paid')
                        <x-button sm text="Apagar" color="red" wire:click="confirmDelete({{$itemWithdrawal['id']}})" />
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div style="padding-top: 15px;">
        {{$response->withdrawals->links()}}
    </div>

</div>
