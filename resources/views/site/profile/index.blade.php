@extends('site.layouts.app')

@section('title', 'EcoLave | Meus Pedidos')

@section('content')

    <main class="page contato">
        <div class="title">
            <span>Meu Perfil</span>
            <h1>Atualize os dados do seu perfil aqui !</h1>
            <p>Acompanhe aqui os seus pedidos, status etc.</p>
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
