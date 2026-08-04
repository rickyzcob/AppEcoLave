<div class="stats">
    <div class="stat-card">
        <div class="icon">👥</div>
        <small>Total de clientes</small>
        <h2>{{$response->total_clients}}</h2>
        <strong>+12% este mês</strong>
    </div>
    <div class="stat-card">
        <div class="icon">🧽</div>
        <small>Total de profissionais</small>
        <h2>{{$response->total_professionals}}</h2>
        <strong>+8 novos</strong>
    </div>
    <div class="stat-card">
        <div class="icon">📦</div>
        <small>Pedidos do dia</small>
        <h2>{{$response->total_orders_today}}</h2>
        <strong>{{$response->total_orders_started}} em andamento</strong>
    </div>
    <div class="stat-card">
        <div class="icon">💰</div>
        <small>Faturamento</small>
        <h2>{{formatMoney($response->total_orders_invoiced)}}</h2>
        <strong>Hoje</strong>
    </div>
    <div class="stat-card">
        <div class="icon">✅</div>
        <small>Concluídos</small>
        <h2>{{$response->total_orders_finished}}</h2>
        <strong>{{$response->total_orders_canceled}} cancelados</strong>
    </div>
</div>
