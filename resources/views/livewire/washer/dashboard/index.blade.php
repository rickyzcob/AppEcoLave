<div>
    <section id="dashboard" class="page-section active">

        <livewire:washer.dashboard.cards.card/>

        <livewire:washer.dashboard.order.card/>


    </section>

    <section id="rota" class="page-section">
        <div class="panel">
            <div class="panel-head">
                <h2>Navegação e Rota</h2>
                <button class="btn" onclick="toast('Rota aberta no Google Maps')">Abrir Google Maps</button>
            </div>

            <div class="order-info">
                <div class="info-box"><span>Endereço do cliente</span><strong>Av. Nazaré, 1200, Belém-PA</strong></div>
                <div class="info-box"><span>Distância</span><strong>1,8 km</strong></div>
                <div class="info-box"><span>Tempo estimado</span><strong>9 minutos</strong></div>
                <div class="info-box"><span>Rota</span><strong>Automática pelo Google Maps</strong></div>
            </div>

            <div style="margin-top:20px; border-radius:24px; overflow:hidden; height:360px; background:#dbeafe; display:flex; align-items:center; justify-content:center; color:#061b2f; font-weight:900; text-align:center; padding:20px;">
                MAPA / GOOGLE MAPS<br>
                Aqui entraria o iframe ou integração da rota automática
            </div>
        </div>
    </section>

    <section id="status" class="page-section">
        <div class="panel">
            <div class="panel-head">
                <h2>Atualização de Status</h2>
                <span class="status andamento">Pedido #2040</span>
            </div>

            <div class="timeline">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div>
                        <h3>A Caminho</h3>
                        <p>Profissional saiu para atendimento.</p>
                        <button class="btn-light" onclick="toast('Status atualizado: A caminho')">Marcar status</button>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div>
                        <h3>Cheguei ao Local</h3>
                        <p>Profissional chegou no endereço do cliente.</p>
                        <button class="btn-light" onclick="toast('Status atualizado: Cheguei ao local')">Marcar status</button>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div>
                        <h3>Serviço Iniciado</h3>
                        <p>Lavagem foi iniciada.</p>
                        <button class="btn-light" onclick="toast('Status atualizado: Serviço iniciado')">Marcar status</button>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div>
                        <h3>Serviço Finalizado</h3>
                        <p>Atendimento concluído com sucesso.</p>
                        <button class="btn" onclick="toast('Serviço finalizado')">Finalizar serviço</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="financeiro" class="page-section">
        <div class="stats">
            <div class="stat-card">
                <div class="icon">💰</div>
                <small>Saldo disponível</small>
                <h2>R$ 348</h2>
                <strong>Liberado</strong>
            </div>

            <div class="stat-card">
                <div class="icon">📈</div>
                <small>Comissão acumulada</small>
                <h2>R$ 1.240</h2>
                <strong>Mês atual</strong>
            </div>

            <div class="stat-card">
                <div class="icon">📤</div>
                <small>Saques solicitados</small>
                <h2>R$ 700</h2>
                <strong>Últimos 30 dias</strong>
            </div>

            <div class="stat-card">
                <div class="icon">🧾</div>
                <small>Pagamentos</small>
                <h2>12</h2>
                <strong>Histórico</strong>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2>Solicitação de saque</h2>
                <button class="btn" onclick="toast('Saque solicitado')">Solicitar saque</button>
            </div>

            <form class="form-grid">
                <div class="input-group">
                    <label>Valor do saque</label>
                    <input type="text" placeholder="R$ 0,00">
                </div>

                <div class="input-group">
                    <label>Chave PIX</label>
                    <input type="text" value="joao@email.com">
                </div>
            </form>
        </div>
    </section>

    <section id="historico" class="page-section">
        <div class="panel">
            <div class="panel-head">
                <h2>Histórico</h2>
                <button class="btn-light">Exportar</button>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Avaliação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#2039</td>
                        <td>Marcos Silva</td>
                        <td>Lavagem Completa</td>
                        <td>R$ 89</td>
                        <td><span class="status concluido">Concluído</span></td>
                        <td>★★★★★</td>
                    </tr>

                    <tr>
                        <td>#2038</td>
                        <td>Ana Paula</td>
                        <td>Lavagem Simples</td>
                        <td>R$ 49</td>
                        <td><span class="status cancelado">Cancelado</span></td>
                        <td>-</td>
                    </tr>

                    <tr>
                        <td>#2037</td>
                        <td>Rafael Costa</td>
                        <td>Limpeza Profunda</td>
                        <td>R$ 119</td>
                        <td><span class="status concluido">Concluído</span></td>
                        <td>★★★★★</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="avaliacoes" class="page-section">
        <div class="grid">
            <div class="panel">
                <div class="panel-head">
                    <h2>Avaliações recebidas</h2>
                </div>

                <div class="list">
                    <div class="list-item">
                        <div>
                            <strong>Marcos Silva</strong>
                            <span>Excelente atendimento, muito caprichoso.</span>
                        </div>
                        <div class="percent">★★★★★</div>
                    </div>

                    <div class="list-item">
                        <div>
                            <strong>Ana Paula</strong>
                            <span>Chegou no horário e fez um ótimo serviço.</span>
                        </div>
                        <div class="percent">★★★★★</div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-head">
                    <h2>Avaliar cliente</h2>
                </div>

                <form class="form-grid">
                    <div class="input-group full">
                        <label>Cliente</label>
                        <select>
                            <option>Marcos Silva</option>
                            <option>Ana Paula</option>
                            <option>Rafael Costa</option>
                        </select>
                    </div>

                    <div class="input-group full">
                        <label>Avaliação por estrelas</label>
                        <div class="rating">★★★★★</div>
                    </div>

                    <div class="input-group full">
                        <label>Comentário descritivo</label>
                        <textarea placeholder="Escreva sua avaliação sobre o cliente"></textarea>
                    </div>

                    <button type="button" class="btn full" onclick="toast('Avaliação enviada')">Enviar avaliação</button>
                </form>
            </div>
        </div>
    </section>
</div>
