@extends('site.layouts.app')

@section('title', 'EcoLave | Planos')

@section('content')

    <main class="page">
        <div class="title">
            <span>Planos</span>
            <h1 class="font-bold">Planos para manter seu carro sempre limpo</h1>
            <p>Escolha o plano ideal para sua rotina.</p>
        </div>
        <div class="cards">
            <div class="card">
                <h3>Básico</h3>
                <span class="preco">R$49</span>
                <p>Lavagem externa, rodas, pneus e acabamento simples.</p>
            </div>
            <div class="card plano-destaque">
                <h3>Premium</h3>
                <span class="preco">R$89</span>
                <p>Lavagem interna e externa com acabamento profissional.</p>
            </div>
            <div class="card">
                <h3>Mensal</h3>
                <span class="preco">R$199</span>
                <p>Lavagens programadas com prioridade no atendimento.</p>
            </div>
        </div>
    </main>
@stop
