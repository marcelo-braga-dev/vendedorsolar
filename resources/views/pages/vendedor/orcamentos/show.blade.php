<x-layout menu="orcamentos" submenu="todos_orcamentos">
    @push('css')
        <style>
            :root{
                /* Paleta e tokens */
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --ink:#0b132b; --muted:#6c757d; --line:#e9ecef; --card:#fff; --page:#f8fafc;
                --good:#2ecc71; --info:#4dabf7; --danger:#e03131;
                --space-1:.25rem; --space-2:.5rem; --space-3:.75rem; --space-4:1rem; --space-5:1.25rem; --space-6:1.5rem;
            }

            body{ background:var(--page); }

            /* ====== Container da página ====== */
            .page-wrap{ padding: var(--space-4) var(--space-2); }
            @media (min-width:768px){ .page-wrap{ padding: var(--space-5) 0; } }

            /* ====== Barra de ações ====== */
            .header-row{ row-gap: var(--space-2); }
            .btn-pill{
                border-radius:12px; font-weight:800; display:inline-flex; align-items:center; gap:.6rem;
                padding:.6rem 1rem;
            }
            .btn-brand{ background:var(--brand); border-color:var(--brand); color:#fff; }
            .btn-brand:hover{ background:var(--brand-600); border-color:var(--brand-600); color:#fff; }
            .btn-ghost{
                background:#fff; border:1px solid var(--line); color:var(--ink);
            }
            .btn-ghost:hover{ background:#fcfcfd; }

            /* ====== Ícone circular padrão ====== */
            .icon-circle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                flex: 0 0 auto;
                color: #fff;
            }
            .ic-orange{ background:var(--brand); }
            .ic-blue{ background:var(--info); }
            .ic-green{ background:var(--good); }
            .ic-danger{ background:var(--danger); }

            /* ====== KPI ====== */
            .kpi{
                border:1px solid var(--line); border-radius:18px; background:var(--card);
                box-shadow:0 10px 28px rgba(16,24,40,.06); transition:transform .12s ease;
            }
            .kpi:hover{ transform:translateY(-3px); }
            .kpi .card-body{ padding: var(--space-5); }
            .kpi .title{
                font-size:.8rem; letter-spacing:.06em; text-transform:uppercase; color:var(--muted); margin:0 0 .25rem;
            }
            .kpi .value{ font-weight:800; font-size:1.8rem; color:var(--ink); }
            .mono{ font-variant-numeric:tabular-nums; }

            /* ====== Cards padrão ====== */
            .card-soft{
                border:1px solid var(--line); border-radius:16px; background:var(--card);
                box-shadow:0 8px 26px rgba(0,0,0,.05);
            }
            .card-soft .card-body{ padding: var(--space-5); }
            .section{ margin-bottom: var(--space-5); }
            .section-title{
                display:flex; align-items:center; gap:.75rem; margin-bottom: var(--space-3);
            }
            .section-title i{ color:var(--muted); font-size:1.1rem; }

            .divider{ border-top:1px dashed var(--line); margin: var(--space-4) 0; }

            /* ====== Tabela enxuta ====== */
            .table td, .table th{ vertical-align:middle; }
            .table th{ font-weight:700; }

            /* ====== Input copiar link ====== */
            .btn-copy{ border-color:var(--brand); color:var(--brand); font-weight:800; }
            .btn-copy:hover{ background:var(--brand); color:#fff; }

            /* ====== Responsivo util ====== */
            .w-100-sm{ width:100%; } @media(min-width:768px){ .w-100-sm{ width:auto; } }

            /* ====== Espaçamentos finos ====== */
            .gap-2{ gap: var(--space-2); }
            .gap-3{ gap: var(--space-3); }
            .gap-4{ gap: var(--space-4); }

            /* Tamanho padrão (seções internas) */
            .icon-circle.sm {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            /* Tamanho médio (seções de destaque) */
            .icon-circle.md {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }

            /* Tamanho grande (KPIs / Botão Voltar) */
            .icon-circle.lg {
                width: 52px;
                height: 52px;
                font-size: 18px;
            }

            /* Paleta de cores */
            .ic-orange { background: var(--brand); }
            .ic-blue   { background: var(--info); }
            .ic-green  { background: var(--good); }
            .ic-danger { background: var(--danger); }
        </style>
    @endpush

    <x-layout.container>
        <div class="page-wrap">
            {{-- Cabeçalho / Ações --}}
            <div class="row align-items-center justify-content-between header-row mb-3">
                <div class="col-md-auto">
                    <a href="{{ route('vendedor.orcamento.index') }}" class="btn btn-ghost btn-pill">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-md-auto">
                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-pill btn-brand"
                           href="{{ route('vendedor.orcamento.vistoria.show', $orcamento->id) }}">
                            <i class="fas fa-camera"></i> Vistoria
                        </a>
                        <a class="btn btn-pill btn-brand"
                           href="{{ route('vendedor.orcamento.aprovacao.show', $orcamento->id) }}">
                            <i class="fas fa-check-circle"></i> Dados para Aprovação
                        </a>
                        @if (implementadoContratos())
                            <a class="btn btn-pill btn-brand"
                               href="{{ route('vendedor.contratos.edit', $orcamento->id) }}">
                                <i class="fas fa-file-signature"></i> Gerar Contrato
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- KPIs --}}
            <div class="row g-3 section">
                <div class="col-12 col-md-4">
                    <div class="kpi h-100">
                        <div class="card-body d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <p class="title">Valor Final</p>
                                <div class="value mono">R$ {{ convert_float_money($orcamento->preco_cliente) }}</div>
                            </div>
                            <span class="icon-circle ic-orange lg shadow"><i class="fas fa-dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="kpi h-100">
                        <div class="card-body d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <p class="title">Geração Estimada</p>
                                <div class="value mono">{{ convert_float_money($orcamento->geracao, 0) }} <small class="text-muted">kWh/mês</small></div>
                            </div>
                            <span class="icon-circle ic-blue lg shadow"><i class="fas fa-sync-alt"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="kpi h-100">
                        <div class="card-body d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <p class="title">Potência do Kit</p>
                                <div class="value mono">
                                    {{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }}
                                    <small class="text-muted">kWp</small>
                                </div>
                            </div>
                            <span class="icon-circle ic-green lg shadow"><i class="fas fa-solar-panel"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cliente + PDF --}}
            <div class="card card-soft section">
                <div class="card-body">
                    <div class="row justify-content-between align-items-start g-3">
                        <div class="col-12 col-lg">
                            <div class="section-title">
                                <i class="fas fa-user-circle"></i>
                                <h4 class="mb-0">Cliente: {{ getNomeCliente($orcamento->clientes_id) }}</h4>
                            </div>

                            <div class="row g-3 small text-muted">
                                <div class="col-12 col-md-auto">
                                    <span class="d-block"><b>ID do Orçamento:</b> #{{ $orcamento->id }}</span>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <span class="d-block"><b>Status:</b> {{ getStatusOrcamentos($orcamento->status) }}</span>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <span class="d-block"><b>Data Criação:</b> {{ date('d/m/Y H:i', strtotime($orcamento->created_at)) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-auto">
                            <input type="hidden" name="grafico_geracao" id="grafico_geracao">
                            <input type="hidden" name="grafico_payback" id="grafico_payback">
                            <button id="btnGerarPdf" class="btn btn-danger btn-pill w-100-sm" onclick="generatePdf()">
                                <i class="fas fa-file-pdf"></i> Abrir PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Anotações --}}
            <div class="card card-soft section">
                <form method="POST" action="{{ route('vendedor.orcamento.update', $orcamento->id) }}"> @csrf @method('PUT')
                    <div class="card-body">
                        <div class="section-title">
                            <i class="fas fa-sticky-note"></i>
                            <h4 class="mb-0">Anotações</h4>
                        </div>
                        <div class="row px-4">
                            <x-inputs.textarea label="Anotações" name="anotacoes">{{ $metas['anotacoes'] }}</x-inputs.textarea>
                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-success btn-pill"><i class="fas fa-save"></i> Salvar</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Link de Compartilhamento --}}
            <div class="card card-soft section">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-share-alt"></i>
                        <h4 class="mb-0">Link de Compartilhamento do Orçamento</h4>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="link" value="{{ route('api.orcamento.show', $orcamento->token) }}" readonly>
                        <button class="btn btn-copy btn-pill" id="url" type="button">Copiar Link</button>
                    </div>
                </div>
            </div>

            {{-- Comissão --}}
            <div class="card card-soft section">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-coins"></i>
                        <h4 class="mb-0">Comissão</h4>
                    </div>
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <small class="text-muted">Valor do Orçamento</small>
                            <div class="mono fw-bold">R$ {{ convert_float_money($orcamento->preco_cliente) }}</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <small class="text-muted">Sua margem de comissão</small>
                            <div class="fw-bold">{{ $orcamentoKit->taxa_comissao }}%</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <small class="text-muted">Comissão</small>
                            <div class="mono fw-bold">R$ {{ convert_float_money($comissao) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informações / Kit --}}
            <div class="row g-3 section">
                <div class="col-md-6">
                    <div class="card card-soft h-100">
                        <div class="card-body">
                            <div class="section-title">
                                <i class="fas fa-map-marked-alt"></i>
                                <h4 class="mb-0">Informações do Local da Instalação</h4>
                            </div>
                            <x-tables.table-default>
                                <x-slot name="head"></x-slot>
                                <x-slot name="body">
                                    @if ($metas['consumo'])
                                        <tr><td>Média Consumo</td><td>{{ $metas['consumo'] }} kWh/mês</td></tr>
                                    @endif
                                    @if ($metas['consumo_fora_ponta'])
                                        <tr><td>Média Consumo <br>Fora da Ponta</td><td>{{ $metas['consumo_fora_ponta'] }} kWh/mês</td></tr>
                                        <tr><td>Média Consumo <br>na Ponta</td><td>{{ $metas['consumo_ponta'] }} kWh/mês</td></tr>
                                        <tr><td>Demanda Contratada</td><td>{{ $metas['demanda'] }} kWh/mês</td></tr>
                                    @endif
                                    <tr><td>Localidade</td><td>{{ getCidadeEstado($orcamento->cidade) }}</td></tr>
                                    <tr><td>Tensão</td><td>{{ $metas['tensao'] }} V</td></tr>
                                    <tr><td>Estrutura</td><td style="white-space:normal">{{ getEstrutura($metas['estrutura']) }}</td></tr>
                                    <tr><td>Direção da Instalação</td><td>{{ getDirecaoInstalacao($metas['orientacao']) }}</td></tr>
                                    <tr><td>Irradiação Solar</td><td>{{ convert_float_money(getIrradiacao($orcamento->cidade)) }} kWh/m²</td></tr>
                                </x-slot>
                            </x-tables.table-default>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-soft h-100">
                        <div class="card-body">
                            <div class="section-title">
                                <i class="fas fa-cogs"></i>
                                <h4 class="mb-0">Detalhes do Kit</h4>
                            </div>

                            <small class="d-block text-muted">Modelo do Kit</small>
                            <p class="mb-2"><b>{{ $orcamentoKit->qtd_kits }}x {{ $kit->modelo }}</b></p>

                            <x-tables.table-default>
                                <x-slot name="head"></x-slot>
                                <x-slot name="body">
                                    <tr class="border-top"><td>ID do Kit</td><td>#{{ $kit->id }}</td></tr>
                                    <tr><td>Potência total</td><td>{{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits) }} kWp</td></tr>
                                    <tr><td>Potência dos Painéis</td><td>{{ $kit->potencia_painel }} W</td></tr>
                                    <tr><td>Tensão de Saída</td><td>{{ $kit->tensao }} V</td></tr>
                                    <tr><td>Marca dos Painéis</td><td>{{ $imagens[$kit->marca_painel]['nome'] }}</td></tr>
                                    <tr><td>Marca do Inversor</td><td>{{ $imagens[$kit->marca_inversor]['nome'] }}</td></tr>
                                </x-slot>
                            </x-tables.table-default>

                            <div class="row mb-3 px-3">
                                <div class="col-6 text-center">
                                    <img class="img-thumbnail" src="{{ asset('storage') . '/' . $imagens[$kit->marca_painel]['logo'] }}" alt="logo painel">
                                </div>
                                <div class="col-6 text-center">
                                    <img class="img-thumbnail" src="{{ asset('storage') . '/' . $imagens[$kit->marca_inversor]['logo'] }}" alt="logo inversor">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Produtos --}}
            <div class="card card-soft section">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-boxes"></i>
                        <h4 class="mb-0">Produtos</h4>
                    </div>
                    <h6 class="text-muted mb-2">Quantidade de Kits: {{ $orcamentoKit->qtd_kits }} kits</h6>
                    {!! nl2br(convertHtmlToText($orcamentoKit->produtos ?? '-')) !!}

                    @if ($kit->observacoes)
                        <div class="divider"></div>
                        <h6 class="text-muted">Observações</h6>
                        <span class="text-secondary">{{ $kit->observacoes }}</span>
                    @endif
                </div>
            </div>

            {{-- Trafo (se houver) --}}
            @if(!empty($trafo))
                <div class="card card-soft section">
                    <div class="card-body">
                        <div class="section-title">
                            <i class="fas fa-bolt"></i>
                            <h4 class="mb-0">Transformador</h4>
                        </div>
                        <small class="d-block text-muted">Modelo</small>
                        <span class="d-block">{{ $trafo->modelo }}</span>
                        <span>Valor: <span class="mono">R$ {{ convert_float_money($trafo->preco_cliente) }}</span></span>
                    </div>
                </div>
            @endif

            {{-- Gráficos --}}
            <div class="card card-soft section">
                <div class="card-body">
                    <div class="section-title">
                        <i class="fas fa-chart-area"></i>
                        <h4 class="mb-0">Geração Fotovoltaica</h4>
                    </div>
                    <x-graficos.geracao-fotovoltaica geracao="{{ $orcamento->geracao }}" cidade="{{ $orcamento->cidade }}"/>
                </div>
            </div>

            <div class="card card-soft">
                <div class="card-body pb-0">
                    <div class="section-title">
                        <i class="fas fa-chart-line"></i>
                        <h4 class="mb-0">Payback</h4>
                    </div>
                    <x-graficos.payback-fotovoltaico preco-cliente="{{ $orcamento->preco_cliente }}"/>
                </div>
            </div>
        </div>
    </x-layout.container>

    @push('js')
        <script>
            // Copiar link (com fallback + feedback)
            (function(){
                const btn = document.getElementById('url');
                if(!btn) return;
                btn.addEventListener('click', function(){
                    const input = document.getElementById('link');
                    input.select(); input.setSelectionRange(0, 99999);
                    const original = btn.innerText;

                    const done = () => { btn.innerText = 'Copiado ✔'; setTimeout(()=> btn.innerText = original, 2200); };

                    navigator.clipboard?.writeText(input.value).then(done).catch(()=>{
                        try{ document.execCommand('copy'); done(); }
                        catch(e){ console.error('Erro ao copiar:', e); }
                    });
                });
            })();

            // Gerar PDF
            async function generatePdf() {
                const graficoGeracao = document.getElementById('grafico_geracao').value;
                const graficoPayback = document.getElementById('grafico_payback').value;

                const payload = {
                    id: {{ $orcamento->id }},
                    grafico_geracao: graficoGeracao,
                    grafico_payback: graficoPayback
                };

                try {
                    const response = await fetch("{{ route('orcamento.pdf') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();
                    const url = data.urlPdf;

                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', "{{ getNomeCliente($orcamento->clientes_id).'_'.$orcamento->geracao.'kwh.pdf'}}");
                    link.setAttribute('target', '_blank');
                    document.body.appendChild(link);
                    link.click();
                } catch (error) {
                    console.error('Erro ao gerar PDF:', error);
                }
            }
        </script>
    @endpush
</x-layout>
