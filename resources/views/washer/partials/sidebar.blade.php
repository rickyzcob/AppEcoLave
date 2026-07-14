<aside class="sidebar" id="sidebar">
    <div class="logo">
        <div class="logo-icon">🧽</div>
        <div>
            <strong>EcoLave</strong>
            <span>Painel do Lavador</span>
        </div>
    </div>

    <div class="profile-mini">
        <livewire:washer.components.online.card/>
    </div>

    <div class="menu">

        <div class="menu-title">Principal</div>

        <button class="{{ request()->routeIs('profissional.dashboard') ? 'active' : '' }}"
                onclick="window.location='{{ route('profissional.dashboard') }}'">
            <span>📊</span> Dashboard
        </button>

        <button class="{{ request()->routeIs('profissional.profile') ? 'active' : '' }}"
                onclick="window.location='{{ route('profissional.profile') }}'">
            <span>👤</span> Meu Perfil
        </button>

        <button class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}"
                onclick="window.location='{{ route('profissional.orders') }}'">
            <span>📦</span> Pedidos
        </button>

        <button data-page="rota">
            <span>🗺️</span> Navegação
        </button>

        <div class="menu-title">Serviço</div>

        <button class="{{ request()->routeIs('profissional.financial') ? 'active' : '' }}"
                onclick="window.location='{{ route('profissional.financial') }}'">
            <span>💰</span> Financeiro
        </button>

        <button class="{{ request()->routeIs('profissional.historic') ? 'active' : '' }}"
                onclick="window.location='{{ route('profissional.historic') }}'">
            <span>📋</span> Histórico
        </button>

        <button class="{{ request()->routeIs('profissional.evaluate') ? 'active' : '' }}"
                onclick="window.location='{{ route('profissional.evaluate') }}'">
            <span>⭐</span> Avaliações
        </button>

        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>🚪</span> Sair
            </button>
        </form>
    </div>
</aside>
