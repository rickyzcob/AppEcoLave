@extends('admin.layouts.app')

@section('title', 'Admin | Dashboard')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Dashboard do Admin', 'phrase' => 'Saldo, comissão, saque e histórico de pagamentos'])

    <livewire:admin.dashboard.index/>

@stop

