@extends('site.layouts.app')

@section('title', 'EcoLave | Meus Pedidos')

@section('content')

    <main class="page order">
        <div class="title">
            <span class="font-bold">Pedidos</span>
            <h1 class="font-bold">Pedidos Realizados</h1>
            <p>Acompanhe aqui os seus pedidos, status etc.</p>
        </div>

        <livewire:site.orders.card/>

    </main>

@stop
