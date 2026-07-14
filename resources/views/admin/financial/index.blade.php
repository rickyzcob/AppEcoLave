@extends('admin.layouts.app')

@section('title', 'Admin | Financeiro')

@section('content')

    @if(auth()->user()->scope === 'admin')
        @include('admin.partials.topbar', ['title' => 'Financeiro', 'phrase' => 'Saldo, comissão, saque e histórico de pagamentos'])
    @endif


    <section id="financeiro" class="page-section active">

{{--        <livewire:admin.financial.washer.informations.card/>--}}

{{--        <div class="panel">--}}
{{--            <livewire:admin.financial.washer.withdrawal.table/>--}}
{{--        </div>--}}

    </section>

@stop
