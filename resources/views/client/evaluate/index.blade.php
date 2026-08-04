@extends('client.layouts.app')

@section('title', 'EcoLave | Avaliações')

@section('content')

<section id="avaliacoes" class="section">

    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-star"></i>
                Avaliações
            </div>
            <div class="section-subtitle">Avalie os serviços realizados</div>
        </div>
    </div>

    <div class="ratings-grid">

        <livewire:client.evaluate.reputation.card/>


        <livewire:client.evaluate.new-evaluate.form/>


        <!-- Formulário de avaliação -->


    </div>

</section>
@stop
