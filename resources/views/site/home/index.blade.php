@extends('site.layouts.app')

@section('title', 'EcoLave | Início')

@section('content')

    <section class="hero">
        <div>
            <h1 class="font-bold">Lavagem ecológica <span>sem água</span> para cuidar do seu carro</h1>
            <p>Seu veículo limpo onde você estiver, com praticidade, produtos de qualidade e uma solução que ajuda a reduzir o desperdício de água.</p>
            <a href="{{route('schedule')}}" class="btn">Agendar Lavagem</a>
        </div>
        <div class="hero-card">
            <img src="https://images.unsplash.com/photo-1607860108855-64acf2078ed9?auto=format&fit=crop&w=900&q=80" alt="Lavagem automotiva">
        </div>
    </section>

    <section>
        <div class="title">
            <span>EcoLave</span>
            <h2>Lavagem moderna, prática e sustentável</h2>
            <p>Uma experiência simples para o cliente e organizada para o lavador.</p>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Atendimento no local</h3>
                <p>Agende em casa, no trabalho ou onde for mais prático para você.</p>
            </div>
            <div class="card">
                <h3>Lavagem sem água</h3>
                <p>Mais cuidado com o veículo e menos desperdício de recursos naturais.</p>
            </div>
            <div class="card">
                <h3>Preço automático</h3>
                <p>Escolha o veículo, o tipo de limpeza e veja o valor na hora.</p>
            </div>
        </div>
    </section>

    <section id="problemas">

        <div class="title">
            <span>Problema que o sistema soluciona</span>
            <h2>Lavagem automotiva mais simples para o cliente e mais organizada para a empresa</h2>
            <p>
                A EcoLave resolve a dificuldade de encontrar um serviço rápido, confiável e prático,
                conectando cliente, lavador e administração em um fluxo simples de pedido.
            </p>
        </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-6 col-span-12">
                    <div class="problema-box">
                        <h3>Antes do sistema</h3>
                        <ul class="lista-beneficios">
                            <li>Cliente perde tempo procurando lava-jato disponível.</li>
                            <li>Atendimento depende de mensagens manuais e informações incompletas.</li>
                            <li>Empresa tem dificuldade para controlar pedidos, horários e lavadores.</li>
                            <li>Cliente não acompanha status, valor e andamento do serviço com clareza.</li>
                        </ul>
                    </div>
                </div>

                <div class="md:col-span-6 col-span-12">
                    <div class="solucao-box">
                        <h3>Com a EcoLave</h3>
                        <ul class="lista-beneficios">
                            <li>Agendamento rápido pelo celular com poucos dados no início.</li>
                            <li>Serviço no endereço do cliente, sem fila e sem deslocamento.</li>
                            <li>Valor estimado antes da confirmação do pedido.</li>
                            <li>Fluxo organizado para cliente, lavador e painel administrativo.</li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <section class="faq" id="faq">
        <div class="title">
            <span>Dúvidas frequentes</span>
            <h2>Acesso rápido ao FAQ</h2>
            <p>Veja as principais respostas antes de finalizar seu agendamento.</p>
        </div>
        <div class="faq-grid">
            <div class="faq-item active"><button type="button" class="faq-question" onclick="toggleFaq(this)">Como funciona o agendamento?<span>+</span></button><div class="faq-answer">O cliente escolhe o veículo, seleciona o tipo de limpeza, informa o endereço e confirma o pedido. Depois acompanha o atendimento pelo status.</div></div>
            <div class="faq-item"><button type="button" class="faq-question" onclick="toggleFaq(this)">Preciso preencher CPF ou CNPJ no cadastro inicial?<span>+</span></button><div class="faq-answer">Não. No primeiro acesso o cliente informa apenas nome, telefone e validação por SMS. CPF ou CNPJ ficam para depois da finalização do pedido.</div></div>
            <div class="faq-item"><button type="button" class="faq-question" onclick="toggleFaq(this)">O endereço é preenchido automaticamente?<span>+</span></button><div class="faq-answer">Sim. Ao digitar o CEP, o sistema busca rua, bairro, cidade e UF automaticamente. O cliente só completa o número e complemento quando necessário.</div></div>
            <div class="faq-item"><button type="button" class="faq-question" onclick="toggleFaq(this)">O atendimento é feito onde o cliente estiver?<span>+</span></button><div class="faq-answer">Sim. O serviço pode ser realizado em casa, empresa, condomínio ou outro local informado no pedido, conforme a área disponível.</div></div>
        </div>
    </section>

@stop

<script>
    function toggleFaq(botao){
        botao.closest('.faq-item').classList.toggle('active');
    }
</script>
