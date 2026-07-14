<div class="panel">
    <div class="panel-head">
        <h2>Histórico</h2>
        <button class="btn-light">Exportar</button>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Valor</th>
                <th>Comissão</th>
                <th class="text-center">Status Pedido</th>
                <th class="text-center">Status</th>
                <th>Avaliação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response->commissions as $itemCommission)
                <tr>
                    <td>#{{$itemCommission['order']['reference']}}</td>
                    <td>{{$itemCommission['order']['user']['name']}}</td>
                    <td>{{$itemCommission['order']['service']['name']}}</td>
                    <td>{{formatMoney($itemCommission['value'])}}</td>
                    <td>{{formatMoney($itemCommission['value_commission'])}}</td>
                    <td class="text-center">
                        <x-badge text="{{$itemCommission['order']['statusLabel']}}" color="{{$itemCommission['order']['statusColor']}}"></x-badge>
                    </td>
                    <td class="text-center">
                        <x-badge text="{{$itemCommission['statusLabel']}}" color="{{$itemCommission['statusColor']}}"></x-badge>
                    </td>
                    <td>
                        @for ($i = 1; $i <= $itemCommission['order']['rate']; $i++)
                            ★
                        @endfor
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
