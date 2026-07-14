@extends('admin.layouts.app')

@section('title', 'Admin | Usuários')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Gestão de Usuários', 'phrase' => 'Adicione, usuários administradores ao sistema'])


    <section id="usuarios" class="page-section active">
        <div class="bg-white  rounded-4xl border-solid p-6">
           <livewire:admin.users.table/>
        </div>
    </section>

@stop

