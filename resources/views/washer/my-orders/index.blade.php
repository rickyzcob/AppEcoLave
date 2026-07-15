@extends('washer.layouts.app')

@section('title', 'Lavador | Meus Pedidos')

@section('content')

    <section id="pedidos" class="page-section active ">

        @include('washer.partials.topbar', ['title' => 'Meus Pedidos', 'phrase' => 'Gerencie os status dos seus pedidos e atualize seu cliente !'])

        <livewire:washer.my-orders.table/>

    </section>

@stop

