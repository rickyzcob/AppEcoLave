@extends('client.layouts.app')

@section('title', 'EcoLave | Planos')

@section('content')

    <section id="ecoclub" class="section">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-crown"></i>
                    EcoClub VIP
                </div>
                <div class="section-subtitle">Escolha o plano ideal para você</div>
            </div>
            <span class="chip chip-orange">
                            <i class="fas fa-crown"></i> Plano atual: Ouro
                        </span>
        </div>

        <div class="plans-grid">

            <!-- Plano Bronze -->
            <div class="plan-card plan-bronze">
                <div class="plan-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <div class="plan-name">Bronze</div>
                <div class="plan-price">
                    <div class="plan-price-main">R$49</div>
                    <div class="plan-price-small">/mês</div>
                </div>
                <div class="plan-washes">
                    <i class="fas fa-car-wash"></i> 4 lavagens simples/mês
                </div>
                <ul class="plan-benefits">
                    <li><i class="fas fa-check check"></i> Lavagem externa incluída</li>
                    <li><i class="fas fa-check check"></i> Cashback de 5%</li>
                    <li><i class="fas fa-check check"></i> Agendamento prioritário</li>
                    <li><i class="fas fa-times cross"></i> <span class="disabled">Lavagem premium</span></li>
                    <li><i class="fas fa-times cross"></i> <span class="disabled">Suporte VIP 24/7</span></li>
                </ul>
                <a href="#" class="btn btn-outline btn-full">Assinar Bronze</a>
            </div>

            <!-- Plano Prata (destaque) -->
            <div class="plan-card plan-silver featured">
                <div class="plan-popular-badge">MAIS POPULAR</div>
                <div class="plan-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="plan-name">Prata</div>
                <div class="plan-price">
                    <div class="plan-price-main">R$89</div>
                    <div class="plan-price-small">/mês</div>
                </div>
                <div class="plan-washes">
                    <i class="fas fa-car-wash"></i> 6 lavagens completas/mês
                </div>
                <ul class="plan-benefits">
                    <li><i class="fas fa-check check"></i> Lavagem interna + externa</li>
                    <li><i class="fas fa-check check"></i> Cashback de 10%</li>
                    <li><i class="fas fa-check check"></i> Agendamento prioritário</li>
                    <li><i class="fas fa-check check"></i> 1 lavagem premium/mês</li>
                    <li><i class="fas fa-times cross"></i> <span class="disabled">Suporte VIP 24/7</span></li>
                </ul>
                <a href="#" class="btn btn-primary btn-full">Assinar Prata</a>
            </div>

            <!-- Plano Ouro -->
            <div class="plan-card plan-gold">
                <div class="plan-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="plan-name">Ouro</div>
                <div class="plan-price">
                    <div class="plan-price-main">R$149</div>
                    <div class="plan-price-small">/mês</div>
                </div>
                <div class="plan-washes">
                    <i class="fas fa-car-wash"></i> Lavagens ilimitadas/mês
                </div>
                <ul class="plan-benefits">
                    <li><i class="fas fa-check check"></i> Lavagem premium incluída</li>
                    <li><i class="fas fa-check check"></i> Cashback de 20%</li>
                    <li><i class="fas fa-check check"></i> Prioridade máxima</li>
                    <li><i class="fas fa-check check"></i> Detalhamento trimestral</li>
                    <li><i class="fas fa-check check"></i> Suporte VIP 24/7</li>
                </ul>
                <a href="#" class="btn btn-full" style="background:linear-gradient(135deg,#D4A017,#F59E0B); color:var(--white); box-shadow:0 4px 14px rgba(213,160,23,0.38);">
                    <i class="fas fa-check-circle"></i> Plano Atual
                </a>
            </div>

        </div>

    </section>

@stop
