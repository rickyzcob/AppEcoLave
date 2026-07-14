@extends('site.layouts.app')

@section('title', 'EcoLave | Área do Lavador')

@section('content')

    <main class="page">
        <div class="title">
            <span>Área do Lavador</span>
            <h1>Acesse ou cadastre-se como lavador</h1>
            <p>Entre com e-mail e senha para acessar seus atendimentos.</p>
        </div>
        <div class="form-box">

            <livewire:site.login.form/>

            <livewire:site.register.washer.form/>

        </div>
    </main>

@stop
