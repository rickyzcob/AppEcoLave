@extends('admin.layouts.app')

@section('title', 'Admin | Comissões')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Gestão das Comissões', 'phrase' => 'Gerencie aqui as comissões que você vai dar aos lavadores'])


    <section id="comissoes" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <livewire:admin.committees.table/>
        </div>
    </section>

@stop
