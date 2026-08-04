<aside class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon">
            <i class="fas fa-leaf"></i>
        </div>
        <div class="sidebar-logo-name">EcoLava BR</div>
        <div class="sidebar-logo-sub">Painel do Cliente</div>
    </div>

    <!-- Navegação -->
    <nav class="sidebar-nav" aria-label="Menu principal">

        <div class="nav-section-label">Principal</div>

        <a href="{{ route('client.dashboard') }}" class="nav-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            Dashboard
        </a>

        <a href="{{ route('client.new-schedule') }}" class="nav-item {{ request()->routeIs('client.new-schedule') ? 'active' : '' }}">
            <i class="fas fa-calendar-plus"></i>
            Novo Agendamento
            <span class="nav-badge">+</span>
        </a>

        <a href="{{ route('client.my-schedule') }}" class="nav-item {{ request()->routeIs('client.my-schedule') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i>
            Meus Agendamentos
        </a>

        <a href="{{ route('client.vehicles') }}" class="nav-item {{ request()->routeIs('client.vehicles') ? 'active' : '' }}">
            <i class="fas fa-car"></i>
            Meus Veículos
        </a>

        <div class="nav-section-label">Benefícios</div>

        <a href="#ecoclub" class="nav-item">
            <i class="fas fa-crown"></i>
            EcoClub VIP
            <span class="nav-badge vip">VIP</span>
        </a>

        <a href="{{ route('client.wallet') }}" class="nav-item {{ request()->routeIs('client.wallet') ? 'active' : '' }}">
            <i class="fas fa-wallet"></i>
            Carteira
        </a>

        <div class="nav-section-label">Conta</div>

        <a href="{{ route('client.historics') }}" class="nav-item {{ request()->routeIs('client.historics') ? 'active' : '' }}">
            <i class="fas fa-history"></i>
            Histórico
        </a>

        <a href="{{ route('client.evaluates') }}" class="nav-item {{ request()->routeIs('client.evaluates') ? 'active' : '' }}">
            <i class="fas fa-star"></i>
            Avaliações
            <span class="nav-badge">3</span>
        </a>

        <a href="{{ route('client.my-profile') }}" class="nav-item {{ request()->routeIs('client.my-profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i>
            Perfil
        </a>

        <a href="{{ route('client.configurations') }}" class="nav-item {{ request()->routeIs('client.configurations') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            Configurações
        </a>

        <div class="nav-section-label">Sessão</div>

        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item nav-item-logout">
                <i class="fas fa-sign-out-alt"></i>
                Sair
            </a>
        </form>

    </nav>

    <!-- Usuário na base da sidebar -->
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">
            <i class="fas fa-user"></i>
        </div>
        <div>
            <div class="sidebar-user-name">{{auth()->user()->name}}</div>
{{--            <div class="sidebar-user-plan">Plano Ouro ⭐</div>--}}
        </div>
    </div>

</aside>
