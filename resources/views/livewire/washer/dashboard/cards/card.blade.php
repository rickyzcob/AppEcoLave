<div>
    <div class="stats">
        <div class="stat-card">
            <div class="icon">📦</div>
            <small>Pedidos hoje</small>
            <h2 class="font-bold">{{$orders['orders_count']}}</h2>
            <strong>{{ $orders['orders_started'] }} em andamento</strong>
        </div>

        <div class="stat-card">
            <div class="icon">✅</div>
            <small>Concluídos</small>
            <h2 class="font-bold">{{$orders['orders_finish']}}</h2>
            <strong>Hoje</strong>
        </div>

        <div class="stat-card">
            <div class="icon">💰</div>
            <small>Saldo disponível</small>
            <h2 class="font-bold">{{formatMoney(auth()->user()->value_commission)}}</h2>
            <strong>Pronto para saque</strong>
        </div>

        <div class="stat-card">
            <div class="icon">⭐</div>
            <small>Avaliação média</small>
            <h2 class="font-bold">{{$evaluate['evaluates_average']}}</h2>
            <strong>{{$evaluate['evaluates_count']}} avaliaçõe(s)</strong>
        </div>
    </div>
</div>
