<header class="header">

    <div class="header-greeting">
        <div class="header-greeting-title">Olá, {{auth()->user()->firstName }}! 👋</div>
        <div class="header-greeting-sub">{{ \App\Helpers\DateHelper::fullNow() }}</div>
    </div>

    <!-- Campo de pesquisa (visual) -->
    <div class="header-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Pesquisar serviços, pedidos...">
    </div>

    <!-- Ícones de ação -->
    <div class="header-actions">
        <a href="#" class="header-icon-btn" title="Notificações">
            <i class="fas fa-bell"></i>
            <span class="badge">3</span>
        </a>
        <a href="#" class="header-icon-btn" title="Mensagens">
            <i class="fas fa-comment-dots"></i>
            <span class="badge">1</span>
        </a>
    </div>

    <!-- Perfil do usuário -->
    <div class="header-profile">
        <div class="header-profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <div class="header-profile-info">
            <div class="header-profile-name">{{auth()->user()->name}}</div>
{{--            <div class="header-profile-role">Cliente VIP ⭐</div>--}}
        </div>
        <i class="fas fa-chevron-down header-profile-chevron"></i>
    </div>

</header>
