<x-layout menu="orcamentos" submenu="">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
                --purple:#6f42c1; --purple-600:#5a32a3;
            }

            /* ====== Botões padrão com ícone à esquerda ====== */
            .btn-icon{
                display:inline-flex; align-items:center; gap:.55rem;
                font-weight:700; border-radius:12px;
                line-height:1; padding:.7rem 1rem;
            }
            .btn-icon .bi{ font-size:1.05rem; line-height:0; transform:translateY(-.5px); }

            .btn-brand{ background:var(--brand); border-color:var(--brand); color:#fff; }
            .btn-brand:hover{ background:var(--brand-600); border-color:var(--brand-600); color:#fff; }

            .btn-ghost{
                background:transparent; border:1px dashed var(--brand-200); color:var(--brand-700);
            }
            .btn-ghost:hover{ background:var(--brand-050); color:var(--brand-700); }

            .btn-purple{ background:var(--purple); border-color:var(--purple); color:#fff; }
            .btn-purple:hover{ background:var(--purple-600); border-color:var(--purple-600); color:#fff; }

            /* ====== KPIs ====== */
            .kpi{
                position:relative; overflow:hidden;
                border:1px solid #eef2f6; border-radius:18px;
                box-shadow:0 10px 30px rgba(0,0,0,.04);
                background:linear-gradient(180deg, #fff 0%, #fcfcfd 100%);
                transition: transform .15s ease;
            }
            .kpi:hover{ transform: translateY(-2px); }
            .kpi-title{ font-size:.78rem; letter-spacing:.04em; color:#6c757d; text-transform:uppercase; margin-bottom:.15rem; }
            .kpi-value{ font-weight:800; font-size:1.65rem; }
            .kpi-bubble{
                position:absolute; right:14px; top:14px;
                width:46px; height:46px; display:flex; align-items:center; justify-content:center;
                border-radius:999px; background:var(--brand-100); color:var(--brand-700);
            }
            .kpi-bubble .bi{ font-size:1.2rem; }

            .mono{ font-variant-numeric: tabular-nums; }

            /* ====== Cards ====== */
            .card-soft{ border:1px solid #eef2f6; border-radius:16px; box-shadow:0 8px 26px rgba(0,0,0,.04); background:#fff; }
            .divider{ border-top:1px dashed #e9ecef; margin:1rem 0; }

            /* ====== Badge suave ====== */
            .badge-soft{
                border-radius:999px; padding:.35rem .65rem; font-weight:800; font-size:.78rem;
                color:var(--brand-700); background:var(--brand-100); border:1px solid var(--brand-200);
            }

            /* ====== Input copiar link ====== */
            .btn-copy{ border-color:var(--brand); color:var(--brand); font-weight:800; }
            .btn-copy:hover{ background:var(--brand); color:#fff; }
            .form-control[readonly]{ background:#fff; }

            /* ====== Tabelas ====== */
            .table td, .table th{ vertical-align: middle; }

            /* ====== Cabeçalhos com ícone em bolha ====== */
            .head-bubble{ display:flex; align-items:center; gap:.7rem; }
            .bubble{
                width:36px; height:36px; border-radius:999px; display:flex; align-items:center; justify-content:center;
                background:#f6f7f9; color:#8a94a6;
            }
            .bubble .bi{ font-size:1rem; }

            /* ====== Logos ====== */
            .brand-thumb{ max-width:120px; object-fit:contain; }

            /* ====== Util responsivo ====== */
            .actions-wrap{ display:flex; flex-wrap:wrap; gap:.6rem; }
            .w-100-sm{ width:100%; }
            @media (min-width:768px){ .w-100-sm{ width:auto; } }
        </style>
    @endpush

    <x-layout.container title="Informações do Orçamento">
        {{-- AÇÕES SUPERIORES --}}
        <div class="row mb-4 justify-content-between g-2">
            <div class="col-md-auto">
                <a class="btn btn-icon btn-ghost" href="{{ route('admin.orcamentos.index') }}">
                    <i class="bi bi-arrow-left"></i><span>Voltar</span>
                </a>
            </div>
            <div class="col-md-auto">
                <div class="actions-wrap">
                    <a class="btn btn-icon btn-brand w-100-sm"
                       href="{{ route('admin.orcamento.vistoria.show', $orcamento->id) }}">
                        <i class="bi bi-camera"></i><span>Vistoria</span>
                    </a>
                    <a class="btn btn-icon btn-brand w-100-sm"
                       href="{{ route('admin.orcamento.aprovacao.show', $orcamento->id) }}">
                        <i class="bi bi-check2-circle"></i><span>Dados para Aprovação</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- KPIs --}}
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <div class="card kpi h-100">
                    <div class="card-body">
                        <div class="kpi-title">Valor Final</div>
                        <div class="kpi-value mono">R$ {{ convert_float_money($orcamento->preco_cliente) }}</div>
                        <div class="kpi-bubble"><i class="bi bi-currency-dollar"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card kpi h-100">
                    <div class="card-body">
                        <div class="kpi-title">Geração Estimada</div>
                        <div class="kpi-value mono">
                            {{ convert_float_money($orcamento->geracao, 0) }}
                            <small class="text-muted">kWh/mês</small>
                        </div>
                        <div class="kpi-bubble"><i class="bi bi-arrow-repeat"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card kpi h-100">
                    <div class="card-body">
                        <div class="kpi-title">Potência do Kit</div>
                        <div class="kpi-value mono">
                            {{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }}
                            <small class="text-muted">kWp</small>
                        </div>
                        <div class="kpi-bubble"><i class="bi bi-sun"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- DADOS + AÇÕES --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-soft">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center g-2">
                            <div class="col-auto">
                                <div class="row g-3">
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block"><b>ID do Orçamento:</b> #{{ $orcamento->id }}</small>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block"><b>Status:</b> {{ getStatusOrcamentos($orcamento->status) }}</small>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block"><b>Data Criação:</b> {{ date('d/m/Y H:i', strtotime($orcamento->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <input type="hidden" name="grafico_geracao" id="grafico_geracao">
                                <input type="hidden" name="grafico_payback" id="grafico_payback">
                                <button id="btnGerarPdf" class="btn btn-icon btn-outline-danger w-100" type="button" onclick="generatePdf()">
                                    <i class="bi bi-filetype-pdf"></i><span>Abrir PDF</span>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-icon btn-success w-100"
                                   href="{{ route('admin.orcamentos.edit', $orcamento->id) }}">
                                    <i class="bi bi-pencil-square"></i><span>Editar</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-icon btn-purple w-100"
                                   href="{{ route('admin.orcamento.status.edit', $orcamento->id) }}">
                                    <i class="bi bi-record-circle"></i><span>Alterar Status</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ANOTAÇÕES --}}
        @if (!empty($orcamento->anotacoes))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card card-soft">
                        <div class="card-body">
                            <div class="head-bubble mb-1">
                                <div class="bubble"><i class="bi bi-journal-text"></i></div>
                                <div class="fw-bold">Anotações</div>
                            </div>
                            <div class="text-muted">{{ $orcamento->anotacoes }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- CLIENTE --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-soft">
                    <div class="card-body">
                        <div class="head-bubble mb-2">
                            <div class="bubble"><i class="bi bi-person-circle"></i></div>
                            <div>
                                <div class="fw-bold">Cliente</div>
                                <div>{{ getNomeCliente($orcamento->clientes_id) }}</div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-auto"><small class="d-block"><b>E-mail:</b> {{ $dadosCliente['email'] ?? '' }}</small></div>
                            <div class="col-md-auto"><small class="d-block"><b>Celular:</b> {{ $dadosCliente['celular'] ?? '' }}</small></div>
                            <div class="col-md-auto"><small class="d-block"><b>Telefone:</b> {{ $dadosCliente['telefone'] ?? '' }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- REPRESENTANTE --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-soft">
                    <div class="card-body">
                        <div class="head-bubble mb-2">
                            <div class="bubble"><i class="bi bi-briefcase"></i></div>
                            <div>
                                <div class="fw-bold">Representante</div>
                                <div>{{ usuario($orcamento->users_id)->name }}</div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-auto"><small class="d-block"><b>E-mail:</b> {{ usuario($orcamento->users_id)->email ?? '' }}</small></div>
                            <div class="col-md-auto"><small class="d-block"><b>Celular:</b> {{ $dadosVendedor['celular'] ?? '-' }}</small></div>
                            <div class="col-md-auto"><small class="d-block"><b>Telefone:</b> {{ $dadosVendedor['telefone'] ?? '-' }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- COMISSÃO --}}
        <div class="card card-soft mb-4">
            <div class="card-body">
                <div class="head-bubble mb-2">
                    <div class="bubble"><i class="bi bi-cash-coin"></i></div>
                    <h4 class="mb-0">Comissão do Vendedor</h4>
                </div>
                <div class="row g-2">
                    <div class="col-12">
                        <span class="d-block">Valor do Orçamento:
                            <span class="mono">R$ {{ convert_float_money($orcamento->preco_cliente) }}</span>
                        </span>
                        <span class="d-block">Margem de comissão:
                            <span class="badge-soft">{{ $orcamentoKit->taxa_comissao }}%</span>
                        </span>
                        <span class="d-block">Comissão:
                            <span class="mono">R$ {{ convert_float_money($comissao) }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- LINK COMPARTILHAMENTO --}}
        <div class="card card-soft mb-4">
            <div class="card-body">
                <div class="head-bubble mb-2">
                    <div class="bubble"><i class="bi bi-share"></i></div>
                    <h4 class="mb-0">Link de Compartilhamento do Orçamento</h4>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" id="link" value="{{ route('api.orcamento.show', $orcamento->token) }}" readonly>
                    <button class="btn btn-copy btn-icon" id="url" type="button"><i class="bi bi-clipboard"></i><span>Copiar Link</span></button>
                </div>
            </div>
        </div>

        {{-- INFO LOCAL & KIT --}}
        <div class="row mb-4 g-3">
            <div class="col-md-6">
                <div class="card card-soft h-100">
                    <div class="card-body pb-0">
                        <x-tables.table-default>
                            <x-slot name="head">Informações do Local da Instalação</x-slot>
                            <x-slot name="body">
                                @if ($metas['consumo'])
                                    <tr><td>Média Consumo</td><td>{{ $metas['consumo'] }} kWh/mês</td></tr>
                                @endif
                                @if ($metas['consumo_fora_ponta'])
                                    <tr><td>Média Consumo <br>Fora da Ponta</td><td>{{ $metas['consumo_fora_ponta'] }} kWh/mês</td></tr>
                                    <tr><td>Média Consumo <br>na Ponta</td><td>{{ $metas['consumo_ponta'] }} kWh/mês</td></tr>
                                @endif
                                <tr><td>Localidade</td><td>{{ getCidadeEstado($orcamento->cidade) }}</td></tr>
                                <tr><td>Tensão</td><td>{{ $metas['tensao'] }} V</td></tr>
                                <tr><td>Estrutura</td><td style="white-space: normal">{{ getEstrutura($metas['estrutura']) }}</td></tr>
                                <tr><td>Direção da Instalação</td><td>{{ getDirecaoInstalacao($metas['orientacao']) }}</td></tr>
                                <tr><td>Irradiação Solar</td><td>{{ convert_float_money(getIrradiacao($orcamento->cidade)) }} kWh/m²</td></tr>
                            </x-slot>
                        </x-tables.table-default>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-soft h-100">
                    <div class="card-body pb-0">
                        <small class="d-block text-muted">Modelo do Kit</small>
                        <p class="mb-2"><b>{{ $orcamentoKit->qtd_kits }}x {{ $kit->modelo }}</b></p>
                        <x-tables.table-default>
                            <x-slot name="head"></x-slot>
                            <x-slot name="body">
                                <tr class="border-top"><th>ID do Kit</th><td>#{{ $kit->id }}</td></tr>
                                <tr><th>Potência Total do Kit</th><td>{{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }} kWp</td></tr>
                                <tr><th>Potência dos Painéis</th><td>{{ $kit->potencia_painel }} W</td></tr>
                                <tr><th>Tensão de Saída</th><td>{{ $kit->tensao }} V</td></tr>
                                <tr><th>Marca dos Painéis</th><td>{{ $imagens[$kit->marca_painel]['nome'] }}</td></tr>
                                <tr><th>Marca do Inversor</th><td>{{ $imagens[$kit->marca_inversor]['nome'] }}</td></tr>
                            </x-slot>
                        </x-tables.table-default>

                        <div class="row mb-4 px-3">
                            <div class="col-6 text-center">
                                <img class="img-thumbnail brand-thumb"
                                     src="{{ asset('storage') . '/' . $imagens[$kit->marca_painel]['logo'] }}"
                                     alt="logo painel">
                                <small class="d-block text-muted">Painéis</small>
                            </div>
                            <div class="col-6 text-center">
                                <img class="img-thumbnail brand-thumb"
                                     src="{{ asset('storage') . '/' . $imagens[$kit->marca_inversor]['logo'] }}"
                                     alt="logo inversor">
                                <small class="d-block text-muted">Inversor</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUTOS --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-soft">
                    <div class="card-body">
                        <div class="head-bubble mb-2">
                            <div class="bubble"><i class="bi bi-box-seam"></i></div>
                            <h4 class="mb-0">Produtos de cada Kit</h4>
                        </div>
                        {!! nl2br(convertHtmlToText($orcamentoKit->produtos ?? '-')) !!}

                        @if ($kit->observacoes)
                            <h5 class="mt-3">Observações</h5>
                            <span class="text-muted">{{ $kit->observacoes }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- TRAFO --}}
        @if(!empty($trafo))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card card-soft">
                        <div class="card-body">
                            <div class="head-bubble mb-2">
                                <div class="bubble"><i class="bi bi-lightning-charge"></i></div>
                                <h4 class="mb-0">Transformador</h4>
                            </div>
                            <small class="d-block text-muted">Modelo</small>
                            <span class="d-block">{{ $trafo->modelo }}</span>
                            <span>Valor: <span class="mono">R$ {{ convert_float_money($trafo->preco_cliente) }}</span></span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- GRÁFICOS --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-soft">
                    <div class="card-body">
                        <x-graficos.geracao-fotovoltaica geracao="{{ $orcamento->geracao }}" cidade="{{ $orcamento->cidade }}"/>
                    </div>
                </div>
            </div>
        </div>

        {{-- PAYBACK --}}
        <div class="row">
            <div class="col-12">
                <div class="card card-soft">
                    <div class="card-body pb-0">
                        <x-graficos.payback-fotovoltaico preco-cliente="{{ $orcamento->preco_cliente }}"/>
                    </div>
                </div>
            </div>
        </div>
    </x-layout.container>

    @push('js')
        <script>
            // Copiar link com fallback
            const btnLink = document.getElementById('url');
            btnLink?.addEventListener('click', function () {
                const input = document.getElementById('link');
                input.select(); input.setSelectionRange(0, 99999);
                navigator.clipboard?.writeText(input.value)
                    .then(() => flashCopy(btnLink))
                    .catch(() => { try{ document.execCommand('copy'); flashCopy(btnLink);}catch(e){} });
            });
            function flashCopy(btn){ const t=btn.innerText; btn.innerText='Copiado ✔'; setTimeout(()=>btn.innerText=t, 2500); }

            // Gerar PDF
            async function generatePdf() {
                const payload = {
                    id: {{ $orcamento->id }},
                    grafico_geracao: document.getElementById('grafico_geracao').value,
                    grafico_payback: document.getElementById('grafico_payback').value
                };
                try {
                    const response = await fetch("{{ route('orcamento.pdf') }}", {
                        method: "POST",
                        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                        body: JSON.stringify(payload)
                    });
                    const data = await response.json();
                    const link = document.createElement('a');
                    link.href = data.urlPdf;
                    link.setAttribute('download', "{{ getNomeCliente($orcamento->clientes_id).'_'.$orcamento->geracao.'kwh.pdf'}}");
                    link.setAttribute('target', '_blank');
                    document.body.appendChild(link); link.click();
                } catch (error) { console.error('Erro ao gerar PDF:', error); }
            }
        </script>
    @endpush
</x-layout>
