@extends('client.layouts.app')

@section('title', 'EcoLave | Configurações')

@section('content')

    <section id="configuracoes" class="section">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-cog"></i>
                    Configurações
                </div>
                <div class="section-subtitle">Personalize sua experiência</div>
            </div>
        </div>

        <div class="settings-grid">

            <!-- Aparência / Tema -->
            <div class="settings-card">
                <div class="settings-card-title">
                    <i class="fas fa-palette"></i> Aparência
                </div>
                <div style="font-size:12.5px; color:var(--text-muted); margin-bottom:14px;">Escolha o tema do painel</div>
                <div class="theme-options">
                    <div class="theme-option">
                        <input type="radio" id="themeLight" name="theme" value="light" checked>
                        <label for="themeLight" class="theme-option-label">
                            <div class="theme-preview preview-light"></div>
                            Claro
                        </label>
                    </div>
                    <div class="theme-option">
                        <input type="radio" id="themeDark" name="theme" value="dark">
                        <label for="themeDark" class="theme-option-label">
                            <div class="theme-preview preview-dark"></div>
                            Escuro
                        </label>
                    </div>
                </div>
            </div>

            <!-- Idioma -->
            <div class="settings-card">
                <div class="settings-card-title">
                    <i class="fas fa-globe"></i> Idioma
                </div>
                <div class="form-group" style="margin-top:4px;">
                    <label class="form-label" for="idioma">
                        <i class="fas fa-language"></i> Idioma do Sistema
                    </label>
                    <select id="idioma" name="idioma" class="form-control">
                        <option value="pt-BR" selected>🇧🇷 Português (Brasil)</option>
                        <option value="en">🇺🇸 English (US)</option>
                        <option value="es">🇪🇸 Español</option>
                    </select>
                </div>
            </div>

            <!-- Notificações -->
            <div class="settings-card">
                <div class="settings-card-title">
                    <i class="fas fa-bell"></i> Notificações
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Notificações Push</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Notificações por E-mail</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Notificações via SMS</span>
                    <label class="toggle">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Promoções e Ofertas</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Privacidade e Segurança -->
            <div class="settings-card">
                <div class="settings-card-title">
                    <i class="fas fa-shield-alt"></i> Privacidade e Segurança
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Autenticação de 2 Fatores</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Histórico Visível</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="settings-row">
                    <span class="settings-row-label">Compartilhar Localização</span>
                    <label class="toggle">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div style="margin-top:16px;">
                    <a href="#" class="btn btn-danger btn-sm btn-full" style="justify-content:center;">
                        <i class="fas fa-trash-alt"></i> Excluir Minha Conta
                    </a>
                </div>
            </div>

        </div>

    </section>

@stop
