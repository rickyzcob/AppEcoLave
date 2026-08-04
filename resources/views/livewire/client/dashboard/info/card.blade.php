<div>
    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </div>
            <div class="section-subtitle">Resumo das suas atividades</div>
        </div>
        <a href="{{route('client.historics')}}" class="link-more">
            Ver histórico <i class="fas fa-arrow-right"></i>
        </a>
    </div>


    @if(empty(auth()->user()->taxpayer_registration) || auth()->user()->phone == null)
        <div class="pb-4">
            <x-alert icon="exclamation-triangle" color="orange" title="Erro!">
                <p>Atualize os seus dados !</p>
                <p>Para fetuar agendamentos e pagamentos você precisa atualizar os seus dados clienta no botao baixo </p>
                <x-slot:footer>
                    <div class="flex justify-end">
                        <x-button href="{{route('client.my-profile')}}" text="Alterar dados pessoais" color="white" sm />
                    </div>
                </x-slot:footer>
            </x-alert>
        </div>
    @endif

    <!-- Cards -->
    <div class="cards-grid">

        <!-- Card 1: Total de Lavagens -->
        <div class="dashboard-card card-green">
            <div class="card-top-row">
                <div class="card-icon-wrap">
                    <i class="fas fa-car-wash"></i>
                </div>
                <span class="card-trend card-trend-up">
                                    <i class="fas fa-arrow-up"></i> +12%
                                </span>
            </div>
            <div class="card-value">48</div>
            <div class="card-label">Total de Lavagens</div>
            <div class="card-desc">Realizadas desde o cadastro</div>
        </div>

        <!-- Card 2: Próximo Agendamento -->
        <div class="dashboard-card card-blue">
            <div class="card-top-row">
                <div class="card-icon-wrap">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <span class="card-trend card-trend-blue">
                    <i class="fas fa-clock"></i> Hoje
                </span>
            </div>
            <div class="card-value card-value-md">15:00h</div>
            <div class="card-label">Próximo Agendamento</div>
            <div class="card-desc">Lavagem Completa — Rua das Flores</div>
        </div>

        <!-- Card 3: Cashback -->
        <div class="dashboard-card card-purple">
            <div class="card-top-row">
                <div class="card-icon-wrap">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <span class="card-trend card-trend-up">
                                    <i class="fas fa-arrow-up"></i> +R$8
                                </span>
            </div>
            <div class="card-value">R$42</div>
            <div class="card-label">Cashback Acumulado</div>
            <div class="card-desc">Disponível para usar</div>
        </div>

        <!-- Card 4: Plano Atual -->
        <div class="dashboard-card card-orange">
            <div class="card-top-row">
                <div class="card-icon-wrap">
                    <i class="fas fa-crown"></i>
                </div>
                <span class="card-trend card-trend-orange">
                                    <i class="fas fa-star"></i> VIP
                                </span>
            </div>
            <div class="card-value card-value-md">Ouro</div>
            <div class="card-label">Plano Atual</div>
            <div class="card-desc">Renova em 15/08/2026</div>
        </div>

        <!-- Card 5: Cupons Disponíveis -->
        <div class="dashboard-card card-pink">
            <div class="card-top-row">
                <div class="card-icon-wrap">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <span class="card-trend card-trend-pink">
                                    <i class="fas fa-fire"></i> Novos
                                </span>
            </div>
            <div class="card-value">5</div>
            <div class="card-label">Cupons Disponíveis</div>
            <div class="card-desc">3 expiram esta semana</div>
        </div>

        <!-- Card 6: Economia Total -->
        <div class="dashboard-card card-teal">
            <div class="card-top-row">
                <div class="card-icon-wrap">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <span class="card-trend card-trend-teal">
                                    <i class="fas fa-arrow-up"></i> +R$23
                                </span>
            </div>
            <div class="card-value">R$187</div>
            <div class="card-label">Economia Total</div>
            <div class="card-desc">Em descontos e cashback</div>
        </div>

    </div>
</div>
