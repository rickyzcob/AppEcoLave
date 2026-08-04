@extends('client.layouts.app')

@section('title', 'EcoLave | Carteira')

@section('content')
    <section id="carteira" class="section">

        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fas fa-wallet"></i>
                    Carteira
                </div>
                <div class="section-subtitle">Gerencie seu saldo e transações</div>
            </div>
        </div>

        <div class="wallet-grid">

            <!-- Saldo -->
            <div class="wallet-balance-card">
                <div class="wallet-label">
                    <i class="fas fa-wallet"></i> Saldo Total
                </div>
                <div class="wallet-amount">
                    <sup>R$</sup>127,50
                </div>
                <div class="wallet-chips-row">
                    <div class="wallet-chip">
                        <i class="fas fa-piggy-bank"></i> Cashback R$42,00
                    </div>
                    <div class="wallet-chip">
                        <i class="fas fa-coins"></i> Créditos R$35,50
                    </div>
                    <div class="wallet-chip">
                        <i class="fas fa-dollar-sign"></i> Saldo R$50,00
                    </div>
                </div>
            </div>

            <!-- Métodos de recarga -->
            <div class="wallet-actions-card">
                <div style="font-size:14.5px; font-weight:700; color:var(--black); margin-bottom:3px;">
                    Adicionar Fundos
                </div>
                <div style="font-size:12.5px; color:var(--text-muted);">Escolha a forma de pagamento</div>
                <div class="wallet-methods-grid">
                    <a href="#" class="wallet-method">
                        <i class="fas fa-qrcode"></i>
                        <span>PIX</span>
                    </a>
                    <a href="#" class="wallet-method">
                        <i class="fas fa-credit-card"></i>
                        <span>Cartão</span>
                    </a>
                    <a href="#" class="wallet-method">
                        <i class="fas fa-barcode"></i>
                        <span>Boleto</span>
                    </a>
                    <a href="#" class="wallet-method">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transferir</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Extrato -->
        <div class="form-card" style="margin-top: 22px;">
            <div style="font-size:14.5px; font-weight:700; color:var(--black); margin-bottom:14px; display:flex; align-items:center; gap:9px;">
                <i class="fas fa-list-alt" style="color:var(--green-primary);"></i> Extrato Recente
            </div>
            <div class="extrato-list">

                <div class="extrato-item">
                    <div class="extrato-icon debit"><i class="fas fa-car-wash"></i></div>
                    <div class="extrato-info">
                        <div class="extrato-title">Lavagem Completa</div>
                        <div class="extrato-date">Hoje, 14h30 — Rua das Flores</div>
                    </div>
                    <div class="extrato-amount debit">− R$55,00</div>
                </div>

                <div class="extrato-item">
                    <div class="extrato-icon credit"><i class="fas fa-piggy-bank"></i></div>
                    <div class="extrato-info">
                        <div class="extrato-title">Cashback Recebido</div>
                        <div class="extrato-date">Ontem, 10h15 — Lavagem Premium</div>
                    </div>
                    <div class="extrato-amount credit">+ R$8,00</div>
                </div>

                <div class="extrato-item">
                    <div class="extrato-icon credit"><i class="fas fa-qrcode"></i></div>
                    <div class="extrato-info">
                        <div class="extrato-title">Recarga via PIX</div>
                        <div class="extrato-date">10/07/2026 — 09h00</div>
                    </div>
                    <div class="extrato-amount credit">+ R$100,00</div>
                </div>

                <div class="extrato-item">
                    <div class="extrato-icon debit"><i class="fas fa-car-wash"></i></div>
                    <div class="extrato-info">
                        <div class="extrato-title">Lavagem Simples</div>
                        <div class="extrato-date">08/07/2026 — Av. Paulista</div>
                    </div>
                    <div class="extrato-amount debit">− R$25,00</div>
                </div>

                <div class="extrato-item">
                    <div class="extrato-icon credit"><i class="fas fa-gift"></i></div>
                    <div class="extrato-info">
                        <div class="extrato-title">Bônus de Fidelidade</div>
                        <div class="extrato-date">05/07/2026 — Programa Ouro</div>
                    </div>
                    <div class="extrato-amount credit">+ R$20,00</div>
                </div>

            </div>
        </div>

    </section>
@stop
