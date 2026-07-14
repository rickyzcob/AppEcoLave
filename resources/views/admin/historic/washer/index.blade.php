@extends('admin.layouts.app')

@section('title', 'Admin | Historico')

@section('content')

    <section id="historico" class="page-section active">

        @include('admin.partials.washer.topbar', ['title' => 'Histórico', 'phrase' => 'Pedidos concluídos, cancelados e avaliações recebidas'])

        <livewire:admin.historics.washer.table/>
    </section>

@stop

