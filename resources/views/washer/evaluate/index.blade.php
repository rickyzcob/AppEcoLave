@extends('washer.layouts.app')

@section('title', 'Lavador | Avaliações')

@section('content')

    <section  class="page-section active">
        @include('washer.partials.topbar', ['title' => 'Avaliações', 'phrase' => 'Avalie clientes e acompanhe seus comentários'])

        <div class="grid">

            <livewire:washer.evaluate.card/>

            <livewire:washer.evaluate-client.card/>
        </div>
    </section>

@stop

