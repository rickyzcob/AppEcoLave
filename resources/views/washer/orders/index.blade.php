@extends('washer.layouts.app')

@section('title', 'Lavador | Pedidos')

@section('content')

    <section id="pedidos" class="page-section active ">

        @include('washer.partials.topbar', ['title' => 'Gestão de Pedidos', 'phrase' => 'Aceite, recuse e acompanhe seus atendimentos'])

        <livewire:washer.orders.table/>

    </section>

@stop

