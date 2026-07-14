@extends('washer.layouts.app')

@section('title', 'Lavador | Dashboard')

@section('content')

    @include('washer.partials.topbar', ['title' => 'Dashboard do Profissional', 'phrase' => 'Acompanhe seus pedidos, ganhos e status de atendimento'])

    <livewire:washer.dashboard.index/>

@stop
