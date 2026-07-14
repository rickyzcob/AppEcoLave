@extends('admin.layouts.app')

@section('title', 'Admin | Saques')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Solicitações de Saque', 'phrase' => 'Veja aqui as solicitações de saques dos profissionais'])

    <section id="usuarios" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <livewire:admin.withdrawal.table/>
        </div>
    </section>

@stop

