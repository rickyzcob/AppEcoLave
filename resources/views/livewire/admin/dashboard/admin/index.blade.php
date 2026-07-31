<div>
    <section id="dashboard" class="page-section active">

        <livewire:admin.dashboard.informations.card/>

        <div class="grid">

            <livewire:admin.dashboard.orders.card/>



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
