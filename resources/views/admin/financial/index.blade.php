@extends('admin.layouts.app')

@section('title', 'Admin | Financeiro')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Financeiro aaa', 'phrase' => 'Saldo, comissão, saque e histórico de pagamentos'])

    <section id="financeiro" class="page-section active">
        <div class="stats">
            <div class="stat-card"><div class="icon">💵</div><small>Recebimentos</small><h2>R$ 42.800</h2><strong>Mês atual</strong></div>
            <div class="stat-card"><div class="icon">📤</div><small>Pagamentos</small><h2>R$ 18.900</h2><strong>Profissionais</strong></div>
            <div class="stat-card"><div class="icon">%</div><small>Comissões</small><h2>R$ 7.240</h2><strong>20%</strong></div>
        </div>
    </section>

@stop
