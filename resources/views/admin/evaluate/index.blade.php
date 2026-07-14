@extends('admin.layouts.app')

@section('title', 'Admin | Avaliações')

@section('content')

    <section  class="page-section active">
        @include('admin.partials.topbar', ['title' => 'Avaliações', 'phrase' => 'Controle de qualidade e avaliações dos clientes e profissionais'])

        <livewire:admin.evaluate.card/>
    </section>

@stop

