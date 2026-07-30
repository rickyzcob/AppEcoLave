<div>
    <div class="panel-head">
        <h2>Solicitações de saque</h2>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Profissional</th>
                    <th>Valor</th>
                    <th>Chave Pix</th>
                    <th>Data Solicitação</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" width="210px">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($response->withdrawals as $itemWithdrawal)
                <tr>
                    <td>{{$itemWithdrawal['user']['name'] ?? 'S/c'}}</td>
                    <td>{{formatMoney($itemWithdrawal['amount'])}}</td>
                    <td>{{$itemWithdrawal['key_pix'] }}</td>
                    <td>{{ formatDateAndTime($itemWithdrawal['created_at']) }} </td>

                    <td class="text-center">
                        <x-badge text="{{$itemWithdrawal['statusLabel']}}" color="{{$itemWithdrawal['statusColor']}}"></x-badge>
                    </td>

                    <td class="text-center">
                        <x-button sm text="Pagar" color="green"  wire:click="openCentralModal('admin.withdrawal.pay.form', {'id': {{$itemWithdrawal['id']}} })"/>
                        @if($itemWithdrawal['file_path'] != null)
                            <x-button sm text="Comprovante" color="blue"  wire:click="downloadProof({{$itemWithdrawal['id']}})"/>
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

