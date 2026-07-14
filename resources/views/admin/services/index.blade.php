@extends('admin.layouts.app')

@section('title', 'Admin | Serviços')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Gestão de Serviços', 'phrase' => 'Configure lavagens, valores e serviços adicionais'])

    <section id="servicos" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <livewire:admin.service.table/>
        </div>
    </section>

@stop
