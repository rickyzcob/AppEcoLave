@extends('site.layouts.app')

@section('title', 'EcoLave | Agendamentos')

@section('content')

    <main class="page agendamento">
        <div class="title">
            <span>Agendamento rápido</span>
            <h1 class="font-bold">Escolha seu veículo e veja o valor</h1>
            <p>Você seleciona o tipo de veículo, o serviço e já vê o preço estimado.</p>
        </div>
        <div class="agendamento-box">
            <livewire:site.schedule.form/>
        </div>
    </main>
@stop
