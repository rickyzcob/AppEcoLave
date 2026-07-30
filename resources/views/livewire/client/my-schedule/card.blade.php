<div>
    @include('client.includes.alerts')
    <section id="status-pedido" class="section">
        @foreach($response->schedules as $itemSchedule)
            <div class="section-header pt-3">
                <div>
                    <div class="section-title">
                        <i class="fas fa-route"></i>
                        Status do Pedido
                    </div>
                    <div class="section-subtitle">Pedido #{{$itemSchedule['reference']}}</div>
                </div>
{{--                <span class="chip chip-blue">--}}
{{--                    <i class="fas fa-sync-alt"></i> {{$itemSchedule['statusLabel']}}--}}
                    <x-badge text="{{$itemSchedule['statusLabel']}}" color="{{$itemSchedule['statusColor']}}"></x-badge>
{{--                </span>--}}
            </div>

            <div class="timeline-card">
                <div class="timeline">
                    @foreach($itemSchedule['statuses'] as $itemStatus)
                        <div class="timeline-step {{$itemStatus['description']}}">
                            <div class="timeline-dot">
                                @if($itemStatus['description'] == 'completed')
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas {{$itemStatus['statusIcon']}}"></i>
                                @endif
                            </div>
                            <div class="timeline-step-label">{{$itemStatus['statusLabel']}}</div>
                            @if($itemStatus['description'] == 'completed')
                                <div class="timeline-step-time">{{formatTime($itemStatus['updated_at'])}}</div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Barra de progresso -->
                <div class="progress-wrapper" style="margin-top: 18px;">
                    <div class="progress-row">
                        <span>Progresso do pedido</span>
                        <span class="progress-value">{{roundDecimal($itemSchedule['percentageComplete'])}}%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{$itemSchedule['percentageComplete']}}%;"></div>
                    </div>

                    @if($itemSchedule['status'] === 'service_finish' && empty($itemSchedule['review']))
                        <div class="form-group form-group-full pt-7" style="margin-top: 6px;">
                            <button wire:click="openCentralModal('client.my-schedule.evaluate.form', {'id': {{$itemSchedule['id']}} })"
                                    class="btn btn-primary btn-lg btn-full">
                                <i class="fas fa-star"></i>
                                AVALIE O SERVIÇO
                            </button>
                        </div>
                    @endif

                    @if($itemSchedule['status'] === 'waiting')
                        <div class="form-group form-group-full pt-7" style="margin-top: 6px;">
                            <a href="{{route('client.payment', ['reference' => $itemSchedule['reference']])}}"
                                    class="btn btn-primary btn-lg btn-full">
                                <i class="fas fa-credit-card"></i>
                                EFETUAR PAGAMENTO
                            </a>
                        </div>
                    @endif
                </div>



            </div>
{{--    </section>--}}

    <hr class="section-divider">

{{--    <section class="section" style="margin-top: -12px;">--}}

{{--        <div class="section-header">--}}
{{--            <div>--}}
{{--                <div class="section-title">--}}
{{--                    <i class="fas fa-map-marked-alt"></i>--}}
{{--                    Localização em Tempo Real--}}
{{--                </div>--}}
{{--                <div class="section-subtitle">Acompanhe o profissional no mapa</div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="map-card pb-5">--}}
{{--            <div class="map-placeholder">--}}
{{--                <div class="map-pin">--}}
{{--                    <i class="fas fa-map-marker-alt"></i>--}}
{{--                </div>--}}
{{--                <div class="map-placeholder-text">--}}
{{--                    <h3>Google Maps — Integração em Breve</h3>--}}
{{--                    <p>Rastreamento em tempo real do profissional</p>--}}
{{--                </div>--}}
{{--                <div class="map-chips">--}}
{{--                                <span class="chip chip-green">--}}
{{--                                    <i class="fas fa-map-pin"></i> Rua das Flores, 123--}}
{{--                                </span>--}}
{{--                    <span class="chip chip-blue">--}}
{{--                                    <i class="fas fa-route"></i> 2,3 km--}}
{{--                                </span>--}}
{{--                    <span class="chip chip-orange">--}}
{{--                                    <i class="fas fa-clock"></i> ~8 min--}}
{{--                                </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @endforeach



    </section>
</div>
