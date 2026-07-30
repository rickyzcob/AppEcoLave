@extends('client.layouts.app')

@section('title', 'EcoLave | Início')

@section('content')

    <section id="dashboard" class="section">
        <livewire:client.dashboard.info.card/>
    </section>


    <hr class="section-divider">

    <section id="status-pedido" class="section">
        <livewire:client.dashboard.last-order.card/>


    </section>

    <hr class="section-divider">

    <section class="section" style="margin-top: -12px;">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-map-marked-alt"></i>
                    Localização em Tempo Real
                </div>
                <div class="section-subtitle">Acompanhe o profissional no mapa</div>
            </div>
        </div>

        <div class="map-card">
            <div class="map-placeholder">
                <div class="map-pin">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="map-placeholder-text">
                    <h3>Google Maps — Integração em Breve</h3>
                    <p>Rastreamento em tempo real do profissional</p>
                </div>
                <div class="map-chips">
                                <span class="chip chip-green">
                                    <i class="fas fa-map-pin"></i> Rua das Flores, 123
                                </span>
                    <span class="chip chip-blue">
                                    <i class="fas fa-route"></i> 2,3 km
                                </span>
                    <span class="chip chip-orange">
                                    <i class="fas fa-clock"></i> ~8 min
                                </span>
                </div>
            </div>
        </div>

    </section>

@stop
