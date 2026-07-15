@extends('washer.layouts.app')

@section('title', 'Lavador | Novos Pedidos')

@section('content')

    <section id="pedidos" class="page-section active ">

        @include('washer.partials.topbar', ['title' => 'Novos Pedidos', 'phrase' => 'Aceite, recuse e acompanhe seus atendimentos'])

        <livewire:washer.new-orders.table/>

    </section>

@stop

