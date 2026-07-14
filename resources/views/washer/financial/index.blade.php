@extends('washer.layouts.app')

@section('title', 'Lavador | Financeiro')

@section('content')

    @include('washer.partials.topbar', ['title' => 'Financeiro', 'phrase' => 'Saldo, comissão, saque e histórico de pagamentos'])

    <section id="financeiro" class="page-section active">

        <livewire:washer.financial.informations.card/>

        <div class="panel">
            <livewire:washer.financial.withdrawal.table/>
        </div>

    </section>

@stop

