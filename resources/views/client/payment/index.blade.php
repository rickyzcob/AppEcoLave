@extends('client.layouts.app')

@section('title', 'EcoLave | Pagamento')

@section('content')

    <section id="pagamento" class="section">
        <livewire:client.payments.card :reference="$reference"/>
    </section>

@stop
