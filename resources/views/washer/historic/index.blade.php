@extends('washer.layouts.app')

@section('title', 'Lavador | Histórico')

@section('content')

    <section id="historico" class="page-section active">

        @include('washer.partials.topbar', ['title' => 'Histórico', 'phrase' => 'Pedidos concluídos, cancelados e avaliações recebidas'])

        <livewire:washer.historics.table/>
    </section>

@stop

