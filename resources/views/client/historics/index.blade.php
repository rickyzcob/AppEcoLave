@extends('client.layouts.app')

@section('title', 'EcoLave | Histórico')

@section('content')
    <section id="historico" class="section">
        <livewire:client.historic.table/>
    </section>
@stop
