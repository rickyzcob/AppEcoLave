@extends('client.layouts.app')

@section('title', 'EcoLave | Meu Perfil')

@section('content')
    <section id="perfil" class="section">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-user-circle"></i>
                    Meu Perfil
                </div>
                <div class="section-subtitle">Gerencie suas informações pessoais</div>
            </div>
        </div>

        <livewire:client.my-profile.form/>

    </section>
@stop
