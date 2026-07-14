@extends('admin.layouts.app')

@section('title', 'Admin | Profissionais')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Gestão de Profissionais', 'phrase' => 'Aprovação, documentos, bloqueio e status dos lavadores'])

    <section id="profissionais" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <livewire:admin.washers.table/>
        </div>
    </section>

@stop

