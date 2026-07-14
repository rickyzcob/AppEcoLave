@extends('site.layouts.app')

@section('title', 'EcoLave | Depoimentos')

@section('content')

    <main class="page depoimentos">
        <div class="title">
            <span>Depoimentos</span>
            <h1 class="font-bold">O que nossos clientes dizem</h1>
            <p>Experiências de quem já usa a EcoLave.</p>
        </div>
        <div class="cards">
            <div class="card depoimento">
                <img src="https://randomuser.me/api/portraits/men/32.jpg">
                <h3>Marcos Silva</h3>
                <div class="estrelas">★★★★★</div>
                <p>Serviço excelente e atendimento rápido.</p>
            </div>
            <div class="card depoimento">
                <img src="https://randomuser.me/api/portraits/women/44.jpg">
                <h3>Ana Paula</h3>
                <div class="estrelas">★★★★★</div>
                <p>Agendei e eles vieram até minha casa.</p>
            </div>
            <div class="card depoimento">
                <img src="https://randomuser.me/api/portraits/men/76.jpg">
                <h3>Rafael Costa</h3><div class="estrelas">★★★★★</div>
                <p>Atendimento profissional e ótimo resultado.</p>
            </div>
        </div>
    </main>

@stop
