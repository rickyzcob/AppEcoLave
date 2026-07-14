@extends('washer.layouts.app')

@section('title', 'Lavador | Perfil')

@section('content')

    @include('washer.partials.topbar', ['title' => 'Perfil do Profissional', 'phrase' => 'Dados pessoais, bancários, área de atuação e disponibilidade'])


    <section id="perfil" class="page-section active">
        <div class="panel">
            <div class="panel-head">
                <h2>Dados do perfil</h2>

            </div>

            <livewire:washer.my-profile.form/>

        </div>
    </section>
@stop
