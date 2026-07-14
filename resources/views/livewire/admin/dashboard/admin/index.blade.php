<div>
    <section id="dashboard" class="page-section active">
        <div class="stats">
            <div class="stat-card"><div class="icon">👥</div><small>Total de clientes</small><h2>1.248</h2><strong>+12% este mês</strong></div>
            <div class="stat-card"><div class="icon">🧽</div><small>Total de profissionais</small><h2>86</h2><strong>+8 novos</strong></div>
            <div class="stat-card"><div class="icon">📦</div><small>Pedidos do dia</small><h2>42</h2><strong>18 em andamento</strong></div>
            <div class="stat-card"><div class="icon">💰</div><small>Faturamento</small><h2>R$ 8.740</h2><strong>Hoje</strong></div>
            <div class="stat-card">
                <div class="icon">✅</div>
                <small>Concluídos</small>
                <h2>31</h2>
                <strong>3 cancelados</strong>
            </div>
        </div>

        <div class="grid">
            <div class="bg-white  rounded-4xl border-solid p-6">
                <div class="panel-head">
                    <h2>Pedidos recentes</h2>
                    <button class="btn-light" onclick="openPage('pedidos')">Ver todos</button>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Serviço</th>
                            <th>Profissional</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>#1024</td>
                            <td>Marcos Silva</td>
                            <td>Lavagem Completa</td>
                            <td>João Lima</td>
                            <td><span class="status andamento">Em andamento</span></td>
                            <td>R$ 89</td>
                            <td class="actions"><button>Editar</button><button>Status</button></td>
                        </tr>
                        <tr>
                            <td>#1023</td>
                            <td>Ana Paula</td>
                            <td>Limpeza Profunda</td>
                            <td>Carlos Mendes</td>
                            <td><span class="status concluido">Concluído</span></td>
                            <td>R$ 119</td>
                            <td class="actions"><button>Ver</button><button>Recibo</button></td>
                        </tr>
                        <tr>
                            <td>#1022</td>
                            <td>Rafael Costa</td>
                            <td>Lavagem Simples</td>
                            <td>Pendente</td>
                            <td><span class="status pendente">Aguardando</span></td>
                            <td>R$ 49</td>
                            <td class="actions"><button onclick="openPage('distribuicao')">Distribuir</button><button>Cancelar</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-4xl border-solid p-6">
                <div class="panel-head">
                    <h2>Distribuição inteligente</h2>
                </div>

                <div class="list">
                    <div class="list-item"><div><strong>Profissional mais próximo</strong><span>João Lima • 1,2 km</span></div><div class="percent">98%</div></div>
                    <div class="list-item"><div><strong>Menor deslocamento</strong><span>Carlos Mendes • 7 min</span></div><div class="percent">92%</div></div>
                    <div class="list-item"><div><strong>Disponíveis agora</strong><span>14 profissionais online</span></div><div class="percent">14</div></div>
                </div>
            </div>
        </div>

        <div class="modules">
            <div class="module-card bg-white"><h3>Gestão de Clientes</h3><ul><li>Cadastro</li><li>Edição</li><li>Bloqueio</li><li>Histórico</li></ul></div>
            <div class="module-card bg-white"><h3>Gestão de Profissionais</h3><ul><li>Aprovação</li><li>Bloqueio</li><li>Documentos</li><li>Status</li></ul></div>
            <div class="module-card bg-white"><h3>Gestão Financeira</h3><ul><li>Recebimentos</li><li>Pagamentos</li><li>Comissões</li><li>Relatórios</li></ul></div>
        </div>
    </section>

    <section id="clientes" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Gestão de Clientes</h2><button class="btn" onclick="toast('Novo cliente salvo')">Novo Cliente</button></div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Nome</th><th>CPF</th><th>Telefone</th><th>Veículo</th><th>Status</th><th>Histórico</th><th>Ações</th></tr></thead>
                    <tbody>
                    <tr><td>Marcos Silva</td><td>000.000.000-00</td><td>(91) 99999-0000</td><td>SUV</td><td><span class="status ativo">Ativo</span></td><td>12 pedidos</td><td class="actions"><button>Editar</button><button>Bloquear</button></td></tr>
                    <tr><td>Ana Paula</td><td>111.111.111-11</td><td>(91) 98888-0000</td><td>Carro Médio</td><td><span class="status ativo">Ativo</span></td><td>7 pedidos</td><td class="actions"><button>Editar</button><button>Bloquear</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="profissionais" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Gestão de Profissionais</h2><button class="btn">Aprovar cadastros</button></div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Profissional</th><th>Telefone</th><th>Documentos</th><th>Status</th><th>Online</th><th>Ações</th></tr></thead>
                    <tbody>
                    <tr><td>João Lima</td><td>(91) 90000-0001</td><td>Aprovados</td><td><span class="status ativo">Ativo</span></td><td>Sim</td><td class="actions"><button>Documentos</button><button>Bloquear</button></td></tr>
                    <tr><td>Carlos Mendes</td><td>(91) 90000-0002</td><td>Pendente</td><td><span class="status pendente">Análise</span></td><td>Não</td><td class="actions"><button>Aprovar</button><button>Reprovar</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="servicos" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Gestão de Serviços</h2><button class="btn" onclick="toast('Serviços atualizados')">Salvar</button></div>
            <form class="form-grid">
                <div class="input-group"><label>Lavagem Simples</label><input value="R$ 49"></div>
                <div class="input-group"><label>Lavagem Completa</label><input value="R$ 89"></div>
                <div class="input-group"><label>Limpeza Profunda</label><input value="R$ 119"></div>
                <div class="input-group"><label>Serviço adicional</label><input value="Higienização interna"></div>
                <div class="input-group span-4"><label>Descrição do serviço</label><textarea>Serviços ecológicos sem água, com foco em economia e preservação ambiental.</textarea></div>
            </form>
        </div>
    </section>

    <section id="pedidos" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Gestão de Pedidos</h2><button class="btn">Novo pedido</button></div>
            <div class="cards-grid">
                <div class="small-card"><h3>Acompanhar pedidos</h3><p>Veja todos os pedidos em tempo real.</p></div>
                <div class="small-card"><h3>Alterar status</h3><p>Pendente, a caminho, em serviço e finalizado.</p></div>
                <div class="small-card"><h3>Redistribuir profissional</h3><p>Troque o lavador responsável pelo pedido.</p></div>
                <div class="small-card"><h3>Cancelamentos</h3><p>Controle os pedidos cancelados.</p></div>
            </div>
        </div>
    </section>

    <section id="distribuicao" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Distribuição Inteligente</h2><button class="btn" onclick="toast('Busca automática iniciada')">Localizar profissional</button></div>
            <div class="list">
                <div class="list-item"><div><strong>Profissional mais próximo</strong><span>João Lima • 1,2 km do cliente</span></div><div class="percent">Selecionar</div></div>
                <div class="list-item"><div><strong>Menor tempo de deslocamento</strong><span>Carlos Mendes • 7 minutos</span></div><div class="percent">Selecionar</div></div>
                <div class="list-item"><div><strong>Profissionais disponíveis</strong><span>14 profissionais ativos agora</span></div><div class="percent">Ver lista</div></div>
            </div>
        </div>
    </section>

    <section id="financeiro" class="page-section">
        <div class="stats">
            <div class="stat-card"><div class="icon">💵</div><small>Recebimentos</small><h2>R$ 42.800</h2><strong>Mês atual</strong></div>
            <div class="stat-card"><div class="icon">📤</div><small>Pagamentos</small><h2>R$ 18.900</h2><strong>Profissionais</strong></div>
            <div class="stat-card"><div class="icon">%</div><small>Comissões</small><h2>R$ 7.240</h2><strong>20%</strong></div>
        </div>
    </section>

    <section id="avaliacoes" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Avaliações e Qualidade</h2></div>
            <div class="cards-grid">
                <div class="small-card"><h3>Clientes</h3><p>Nota média 4.9 ⭐</p></div>
                <div class="small-card"><h3>Profissionais</h3><p>Nota média 4.8 ⭐</p></div>
                <div class="small-card"><h3>Controle de qualidade</h3><p>12 atendimentos revisados hoje.</p></div>
                <div class="small-card"><h3>Reclamações</h3><p>2 pendentes de resposta.</p></div>
            </div>
        </div>
    </section>

    <section id="relatorios" class="page-section">
        <div class="modules">
            <div class="module-card"><h3>Faturamento diário</h3><ul><li>Hoje R$ 8.740</li><li>42 pedidos</li></ul></div>
            <div class="module-card"><h3>Faturamento mensal</h3><ul><li>Mês R$ 42.800</li><li>Crescimento 18%</li></ul></div>
            <div class="module-card"><h3>Rankings</h3><ul><li>Profissional: João Lima</li><li>Cliente: Marcos Silva</li></ul></div>
        </div>
    </section>

    <section id="banners" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Banners do Site</h2><button class="btn">Salvar banner</button></div>
            <form class="form-grid">
                <div class="input-group span-2"><label>Título do banner</label><input value="Lavagem ecológica sem água"></div>
                <div class="input-group span-2"><label>Imagem do banner</label><input type="file"></div>
                <div class="input-group span-4"><label>Texto auxiliar</label><textarea>Seu veículo limpo onde você estiver, com economia de água e praticidade.</textarea></div>
            </form>
        </div>
    </section>

    <section id="cupons" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Cupons Promocionais</h2><button class="btn">Criar cupom</button></div>
            <div class="cards-grid">
                <div class="small-card"><h3>ECO10</h3><p>10% de desconto ativo.</p></div>
                <div class="small-card"><h3>PRIMEIRA</h3><p>R$ 15 de desconto na primeira lavagem.</p></div>
            </div>
        </div>
    </section>

    <section id="configuracoes" class="page-section">
        <div class="bg-white rounded-4xl border-solid p-6">
            <div class="panel-head"><h2>Configurações Gerais</h2><button class="btn" onclick="toast('Configurações salvas')">Salvar alterações</button></div>
            <form class="form-grid">
                <div class="input-group"><label>Taxa de comissão</label><input value="20%"></div>
                <div class="input-group"><label>Lavagem Simples</label><input value="R$ 49"></div>
                <div class="input-group"><label>Lavagem Completa</label><input value="R$ 89"></div>
                <div class="input-group"><label>Limpeza Profunda</label><input value="R$ 119"></div>
                <div class="input-group"><label>Horário inicial</label><input type="time" value="08:00"></div>
                <div class="input-group"><label>Horário final</label><input type="time" value="18:00"></div>
                <div class="input-group"><label>Cupom promocional</label><input value="ECO10"></div>
                <div class="input-group"><label>Banner ativo</label><select><option>Banner ecológico ativo</option><option>Banner promocional</option></select></div>
            </form>
        </div>
    </section>
</div>
