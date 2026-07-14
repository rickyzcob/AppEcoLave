@extends('washer.layouts.app')

@section('title', 'Lavador | Comissões')

@section('content')

    <section id="comissoes" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <livewire:admin.committees.table/>
        </div>
    </section>

@stop
