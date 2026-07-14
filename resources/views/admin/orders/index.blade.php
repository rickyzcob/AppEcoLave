@extends('admin.layouts.app')

@section('title', 'Admin | Pedidos')

@section('content')

    <section id="pedidos" class="page-section active ">
        @include('admin.partials.topbar', ['title' => 'Gestão de Pedidos', 'phrase' => 'Acompanhe pedidos, altere status e redistribua profissionais'])

        <div class="bg-white rounded-4xl border-solid p-6 shadow">
            <livewire:admin.orders.manager.table/>
        </div>
    </section>

@stop

