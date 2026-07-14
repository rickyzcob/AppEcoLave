<div class="stats">
    <div class="stat-card">
        <div class="icon">💰</div>
        <small>Saldo disponível</small>
        <h2 class="font-bold"> {{formatMoney($response->balance)}}</h2>
        <strong>Liberado</strong>
    </div>

    <div class="stat-card">
        <div class="icon">📈</div>
        <small>Comissão acumulada</small>
        <h2 class="font-bold">{{formatMoney($response->commissions)}}</h2>
        <strong>Mês atual</strong>
    </div>

    <div class="stat-card">
        <div class="icon">📤</div>
        <small>Saques solicitados</small>
        <h2 class="font-bold">{{formatMoney($response->withdrawals)}}</h2>
        <strong>Últimos 30 dias</strong>
    </div>

    <div class="stat-card">
        <div class="icon">🧾</div>
        <small>Pagamentos</small>
        <h2 class="font-bold">{{$response->payments}}</h2>
        <strong>Histórico</strong>
    </div></div>
