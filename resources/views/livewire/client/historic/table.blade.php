<div>
    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-history"></i>
                Histórico de Lavagens
            </div>
            <div class="section-subtitle">Todas as suas lavagens realizadas</div>
        </div>
    </div>

    <div class="table-card">

        <livewire:client.historic.filter/>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th>Data</th>
                    <th>Serviço</th>
                    <th>Profissional</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Avaliação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($response->historics as $itemHistoric)
                    <tr>
                        <td>{{formatDate($itemHistoric['date_schedule'])}}</td>
                        <td>
                            <div class="td-service-name">{{$itemHistoric['service']['name']}}</div>
                            <div class="td-service-sub">{{$itemHistoric['vehicle']['name']}}</div>
                        </td>
                        <td>
                            <div class="professional-cell">
{{--                                <div class="professional-avatar" style="background:#00C9A7;">{{$itemHistoric['washer']['']}}</div>--}}
                                {{$itemHistoric['washer']['name'] ?? 'Sem Profissional'}}
                            </div>
                        </td>
                        <td class="text-center"><strong>{{formatMoney($itemHistoric['service']['price'])}}</strong></td>
                        <td class="text-center"><x-badge text="{{$itemHistoric['statusLabel']}}" color="{{$itemHistoric['statusColor']}}"></x-badge></td>
                        <td class="text-center">
                            @if($itemHistoric['review'] != null)
                            <span class="stars-display"> {{ str_repeat('★', $itemHistoric['review']['rate']) . str_repeat('☆', 5 - $itemHistoric['review']['rate']) }}</span>
                            @else
                            <span style="color:var(--text-muted); font-size:12px;">S/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
