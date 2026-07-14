@extends('admin.layouts.app')

@section('title', 'Admin | Meu Perfil')

@section('content')

    @include('admin.partials.topbar', ['title' => 'Perfil do Profissional', 'phrase' => 'Dados pessoais, bancários, área de atuação e disponibilidade'])


    <section id="perfil" class="page-section active">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head">
                <h2>Dados do perfil</h2>
            </div>

            <livewire:admin.my-profile.form/>
        </div>
    </section>
@stop
