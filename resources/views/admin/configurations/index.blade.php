@extends('admin.layouts.app')

@section('title', 'Admin | Configurações')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Configurações Gerais', 'phrase' => 'Taxas, valores, horários e configurações do sistema'])


    <section id="configuracoes" class=" active">


                <div class="bg-white  rounded-4xl border-solid p-6">
                    <livewire:admin.configurations.form/>
                </div>

    </section>

@stop
