@extends('site.layouts.app')

@section('title', 'EcoLave | Área do Cliente')

@section('content')

    <main class="page">
        <div class="title">
            <span>Área do Cliente</span>
            <h1 class="font-bold">Acesse ou crie sua conta</h1>
            <p>Depois do cadastro, o acesso será feito com e-mail e senha.</p>
        </div>

        <div class="text-center max-w-[1000px] mx-auto mb-[55px]">
            {{--            @include('site.includes.alerts')--}}
        </div>

        <div class="form-box">
            <livewire:site.login.reset-password :token="$token"/>

            <livewire:site.register.client.form/>
        </div>
    </main>
@stop
