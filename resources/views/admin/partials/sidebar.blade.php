<aside class="sidebar" id="sidebar">
    <div class="logo">
        <div class="logo-icon">🚗</div>
        <div>
            <strong>EcoLave</strong>
            <span>Painel Administrativo</span>
        </div>
    </div>

    <div class="menu">

        <div class="menu-title">
            Principal
        </div>

        <button class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.dashboard') }}'">
            <span>📊</span> Dashboard
        </button>

        <button class="{{ request()->routeIs('admin.clients') ? 'active' : '' }}"
                 onclick="window.location='{{ route('admin.clients') }}'">
            <span>👥</span> Clientes
        </button>

        <button class=" {{ request()->routeIs('admin.washers') ? 'active' : '' }}"
                 onclick="window.location='{{ route('admin.washers') }}'">
            <span>🧽</span> Profissionais
        </button>

        <button class=" {{ request()->routeIs('admin.committees') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.committees') }}'">
            <span>💰</span> Comissões
        </button>

        <button class="{{ request()->routeIs('admin.services') ? 'active' : '' }}"
                 onclick="window.location='{{ route('admin.services') }}'">
            <span>🚘</span> Serviços
        </button>

        <button class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.orders') }}'">
            <span>📦</span> Pedidos
        </button>

        <div class="menu-title">Operação</div>

        <button data-page="distribuicao">
            <span>📍</span> Distribuição Inteligente
        </button>

        <button class="{{ request()->routeIs('admin.financial') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.financial') }}'">
            <span>💰</span> Financeiro
        </button>

        <button class="{{ request()->routeIs('admin.withdrawal') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.withdrawal') }}'">
            <span>💸</span> Solicitações de Saque
        </button>


        <button class="{{ request()->routeIs('admin.evaluate') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.evaluate') }}'">
            <span>⭐</span> Avaliações
        </button>

        <button data-page="relatorios">
            <span>📈</span> Relatórios
        </button>

        <div class="menu-title">Sistema</div>

        <button class="{{ request()->routeIs('admin.users') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.users') }}'">
            <span>👥</span> Usuários
        </button>

        <div class="menu-title">Site</div>

        <button data-page="banners">
            <span>🖼️</span> Banners do Site
        </button>
        <button data-page="cupons">
            <span>🎟️</span> Cupons
        </button>

        <button class="{{ request()->routeIs('admin.configurations') ? 'active' : '' }}"
                onclick="window.location='{{ route('admin.configurations') }}'">
            <span>⚙️</span> Configurações
        </button>

    </div>
</aside>
