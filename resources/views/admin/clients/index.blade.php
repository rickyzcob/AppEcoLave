@extends('admin.layouts.app')

@section('title', 'Admin | Clientes')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Gestão de Clientes', 'phrase' => 'Cadastro, edição, bloqueio e histórico dos clientes'])


    <section id="clientes" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <livewire:admin.clients.table/>
        </div>
    </section>

@stop

