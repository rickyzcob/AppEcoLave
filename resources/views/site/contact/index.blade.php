@extends('site.layouts.app')

@section('title', 'EcoLave | Contato')

@section('content')

    <main class="page contato">
        <div class="title">
            <span>Contato</span>
            <h1 class="font-bold">Fale com a EcoLave</h1>
            <p>Preencha os dados e nossa equipe entrará em contato.</p>
        </div>
        <form class="formulario">
            <input type="text" placeholder="Nome completo">
            <input type="text" placeholder="WhatsApp">
            <input type="email" placeholder="E-mail">
            <input type="text" placeholder="Veículo">
            <textarea rows="5" placeholder="Mensagem">

            </textarea>
            <button type="submit">Enviar Solicitação</button>
        </form>
    </main>

@stop
