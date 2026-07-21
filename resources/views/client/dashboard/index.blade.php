@extends('client.layouts.app')

@section('title', 'EcoLave | Início')

@section('content')

    <section id="dashboard" class="section">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </div>
                <div class="section-subtitle">Resumo das suas atividades</div>
            </div>
            <a href="#historico" class="link-more">
                Ver histórico <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Cards -->
        <div class="cards-grid">

            <!-- Card 1: Total de Lavagens -->
            <div class="dashboard-card card-green">
                <div class="card-top-row">
                    <div class="card-icon-wrap">
                        <i class="fas fa-car-wash"></i>
                    </div>
                    <span class="card-trend card-trend-up">
                                    <i class="fas fa-arrow-up"></i> +12%
                                </span>
                </div>
                <div class="card-value">48</div>
                <div class="card-label">Total de Lavagens</div>
                <div class="card-desc">Realizadas desde o cadastro</div>
            </div>

            <!-- Card 2: Próximo Agendamento -->
            <div class="dashboard-card card-blue">
                <div class="card-top-row">
                    <div class="card-icon-wrap">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="card-trend card-trend-blue">
                                    <i class="fas fa-clock"></i> Hoje
                                </span>
                </div>
                <div class="card-value card-value-md">15:00h</div>
                <div class="card-label">Próximo Agendamento</div>
                <div class="card-desc">Lavagem Completa — Rua das Flores</div>
            </div>

            <!-- Card 3: Cashback -->
            <div class="dashboard-card card-purple">
                <div class="card-top-row">
                    <div class="card-icon-wrap">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <span class="card-trend card-trend-up">
                                    <i class="fas fa-arrow-up"></i> +R$8
                                </span>
                </div>
                <div class="card-value">R$42</div>
                <div class="card-label">Cashback Acumulado</div>
                <div class="card-desc">Disponível para usar</div>
            </div>

            <!-- Card 4: Plano Atual -->
            <div class="dashboard-card card-orange">
                <div class="card-top-row">
                    <div class="card-icon-wrap">
                        <i class="fas fa-crown"></i>
                    </div>
                    <span class="card-trend card-trend-orange">
                                    <i class="fas fa-star"></i> VIP
                                </span>
                </div>
                <div class="card-value card-value-md">Ouro</div>
                <div class="card-label">Plano Atual</div>
                <div class="card-desc">Renova em 15/08/2026</div>
            </div>

            <!-- Card 5: Cupons Disponíveis -->
            <div class="dashboard-card card-pink">
                <div class="card-top-row">
                    <div class="card-icon-wrap">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <span class="card-trend card-trend-pink">
                                    <i class="fas fa-fire"></i> Novos
                                </span>
                </div>
                <div class="card-value">5</div>
                <div class="card-label">Cupons Disponíveis</div>
                <div class="card-desc">3 expiram esta semana</div>
            </div>

            <!-- Card 6: Economia Total -->
            <div class="dashboard-card card-teal">
                <div class="card-top-row">
                    <div class="card-icon-wrap">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <span class="card-trend card-trend-teal">
                                    <i class="fas fa-arrow-up"></i> +R$23
                                </span>
                </div>
                <div class="card-value">R$187</div>
                <div class="card-label">Economia Total</div>
                <div class="card-desc">Em descontos e cashback</div>
            </div>

        </div>
        <!-- /Cards -->

    </section>

    <hr class="section-divider">

    <section id="status-pedido" class="section">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-route"></i>
                    Status do Pedido
                </div>
                <div class="section-subtitle">Pedido #ECO-20260714-001</div>
            </div>
            <span class="chip chip-blue">
                            <i class="fas fa-sync-alt"></i> Em andamento
                        </span>
        </div>

        <div class="timeline-card">

            <div class="timeline">

                <!-- Etapa 1: Pedido Recebido -->
                <div class="timeline-step completed">
                    <div class="timeline-dot">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="timeline-step-label">Pedido Recebido</div>
                    <div class="timeline-step-time">14h30</div>
                </div>

                <!-- Etapa 2: Pedido Aceito -->
                <div class="timeline-step completed">
                    <div class="timeline-dot">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="timeline-step-label">Pedido Aceito</div>
                    <div class="timeline-step-time">14h32</div>
                </div>

                <!-- Etapa 3: Profissional a Caminho (ativa) -->
                <div class="timeline-step active">
                    <div class="timeline-dot">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <div class="timeline-step-label">Profissional a Caminho</div>
                    <div class="timeline-step-time">Agora</div>
                </div>

                <!-- Etapa 4: Em Serviço -->
                <div class="timeline-step">
                    <div class="timeline-dot">
                        <i class="fas fa-spray-can"></i>
                    </div>
                    <div class="timeline-step-label">Em Serviço</div>
                    <div class="timeline-step-time">—</div>
                </div>

                <!-- Etapa 5: Finalizado -->
                <div class="timeline-step">
                    <div class="timeline-dot">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div class="timeline-step-label">Finalizado</div>
                    <div class="timeline-step-time">—</div>
                </div>

            </div>

            <!-- Barra de progresso -->
            <div class="progress-wrapper" style="margin-top: 18px;">
                <div class="progress-row">
                    <span>Progresso do pedido</span>
                    <span class="progress-value">60%</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: 60%;"></div>
                </div>
            </div>

        </div>
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
