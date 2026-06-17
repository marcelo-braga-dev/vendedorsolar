<x-layout menu="integracoes" submenu="eldeltec">
    @push('css')
        <style>
            :root {
                --ink: #0f172a; --muted: #64748b; --line: #e5e7eb;
                --brand: #e25507; --brand-600: #cc4c06; --brand-050: #fff4ed;
                --green: #16a34a; --red: #dc2626; --yellow: #ca8a04;
            }
            .card-glass {
                background: #fff;
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 6px 20px rgba(0,0,0,.05);
            }
            /* KPI cards */
            .kpi-card { padding: 1.1rem 1.25rem; }
            .kpi-card .kpi-icon {
                width: 42px; height: 42px;
                display: grid; place-items: center;
                border-radius: 12px; font-size: 1.2rem;
                flex-shrink: 0;
            }
            .kpi-card .kpi-val { font-weight: 900; font-size: 1.6rem; line-height: 1; color: var(--ink); }
            .kpi-card .kpi-label { font-size: .78rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .04em; }
            .kpi-card .kpi-sub { font-size: .82rem; color: var(--muted); margin-top: .2rem; }
            /* Badges */
            .badge-soft { border-radius: 999px; padding: .28rem .65rem; font-weight: 800; font-size: .72rem; border: 1px solid transparent; }
            .badge-ok  { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
            .badge-warn{ background: #fff7ed; color: #9a3412; border-color: #fed7aa; }
            .badge-err { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
            .badge-info{ background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
            .badge-grey{ background: #f8fafc; color: #475569; border-color: #e2e8f0; }
            /* Tabs */
            .tabs-line { border-bottom: 2px solid var(--line); margin-bottom: 1.25rem; }
            .tabs-line .tab-btn {
                background: none; border: none; padding: .55rem 1rem;
                font-weight: 700; color: var(--muted); border-bottom: 3px solid transparent;
                margin-bottom: -2px; cursor: pointer; transition: .15s;
            }
            .tabs-line .tab-btn.active, .tabs-line .tab-btn:hover { color: var(--brand); border-bottom-color: var(--brand); }
            .tab-panel { display: none; }
            .tab-panel.active { display: block; }
            /* Table */
            .table thead th { font-weight: 800; color: var(--ink); border-bottom: 1px solid #eaeef4; font-size: .83rem; }
            .table tbody tr:hover td { background: #fafbfc; }
            .table td, .table th { vertical-align: middle; font-size: .88rem; }
            /* Produto row */
            .prod-sku { font-family: monospace; font-size: .78rem; color: var(--muted); }
            .prod-name { font-weight: 700; color: var(--ink); }
            .btn-icon { border: 1px solid var(--line); background: #fff; border-radius: 8px; padding: .3rem .5rem; color: var(--muted); }
            .btn-icon:hover { border-color: #c8cdd5; background: #f8fafc; }
            /* Barra de progresso */
            .bar-wrap { background: #f1f5f9; border-radius: 999px; height: 8px; overflow: hidden; }
            .bar-fill  { height: 100%; border-radius: 999px; background: var(--brand); }
            /* Progress ring */
            .ring-wrap { position: relative; width: 80px; height: 80px; flex-shrink: 0; }
            .ring-wrap svg { transform: rotate(-90deg); }
            .ring-val { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.1rem; color: var(--ink); }
            /* Log lines */
            .log-line { font-family: monospace; font-size: .78rem; color: #374151; background: #f8fafc; border-radius: 6px; padding: .3rem .5rem; margin-bottom: .25rem; }
            /* search strip */
            .search-strip { background: #f8fafc; border: 1px solid #eef2f6; border-radius: 12px; padding: .7rem 1rem; }
            /* Seção título */
            .section-hd { font-weight: 900; color: var(--ink); font-size: 1rem; margin-bottom: .25rem; }
            /* chip status */
            .chip-st { display: inline-flex; align-items: center; gap: .35rem; border: 1px solid var(--line); border-radius: 999px; padding: .2rem .7rem; font-weight: 700; font-size: .8rem; cursor: pointer; text-decoration: none; color: var(--muted); }
            .chip-st.active { border-color: var(--brand); color: var(--brand); background: var(--brand-050); }
        </style>
    @endpush

    <x-body title="Integração Edeltec" class="p-4">

        {{-- ── HEADER ─────────────────────────────────────────────────────── --}}
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span style="font-size:1.5rem">⚡</span>
                    <h4 class="mb-0 fw-900" style="color:var(--ink)">Edeltec — Painel de Integração</h4>
                </div>
                <p class="text-muted mb-0" style="font-size:.9rem">
                    Sincronização automática de kits fotovoltaicos da distribuidora Edeltec.
                    Execução diária às 04h via <code>php artisan app:integracao-edeltec</code>.
                </p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.integracoes.eldeltec.integrar') }}"
                   class="btn btn-success d-flex align-items-center gap-1">
                    <i class="bi bi-play-circle-fill"></i> Executar Agora
                </a>
            </div>
        </div>

        {{-- ── KPI CARDS ───────────────────────────────────────────────────── --}}
        <div class="row g-3 mb-4">
            {{-- Produtos Ativos --}}
            <div class="col-6 col-md-3">
                <div class="card-glass kpi-card h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-box-seam-fill"></i></div>
                        <div>
                            <div class="kpi-val">{{ number_format($totalAtivos) }}</div>
                            <div class="kpi-label">Kits Ativos</div>
                            <div class="kpi-sub text-danger">{{ number_format($totalInativos) }} inativos</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Última Sync --}}
            <div class="col-6 col-md-3">
                <div class="card-glass kpi-card h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon" style="background:#eff6ff;color:#1d4ed8"><i class="bi bi-clock-history"></i></div>
                        <div>
                            <div class="kpi-val" style="font-size:1rem;line-height:1.3">
                                {{ $ultimaSync ? $ultimaSync->data_inicio_fmt : '—' }}
                            </div>
                            <div class="kpi-label">Última Sync</div>
                            @if($ultimaSync)
                                <span class="badge-soft {{ $ultimaSync->badge_class }}" style="font-size:.7rem">{{ $ultimaSync->status }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Total Syncs --}}
            <div class="col-6 col-md-3">
                <div class="card-glass kpi-card h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon" style="background:#fff7ed;color:#c2410c"><i class="bi bi-arrow-repeat"></i></div>
                        <div>
                            <div class="kpi-val">{{ $totalSyncs }}</div>
                            <div class="kpi-label">Total Execuções</div>
                            <div class="kpi-sub">
                                <span style="color:var(--green)">{{ $totalSucessos }} ok</span>
                                · <span style="color:var(--red)">{{ $totalFalhas }} falha</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Taxa de Sucesso --}}
            <div class="col-6 col-md-3">
                <div class="card-glass kpi-card h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="ring-wrap">
                            @php $circunf = 2 * pi() * 32; $dash = $circunf * $taxaSucesso / 100; @endphp
                            <svg width="80" height="80" viewBox="0 0 80 80">
                                <circle cx="40" cy="40" r="32" fill="none" stroke="#f1f5f9" stroke-width="9"/>
                                <circle cx="40" cy="40" r="32" fill="none"
                                    stroke="{{ $taxaSucesso >= 80 ? '#16a34a' : ($taxaSucesso >= 50 ? '#ca8a04' : '#dc2626') }}"
                                    stroke-width="9"
                                    stroke-dasharray="{{ $dash }} {{ $circunf }}"
                                    stroke-linecap="round"/>
                            </svg>
                            <div class="ring-val">{{ $taxaSucesso }}%</div>
                        </div>
                        <div>
                            <div class="kpi-label">Taxa de Sucesso</div>
                            <div class="kpi-sub">Méd. {{ number_format($mediaImportados) }} kits/sync</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── ABAS PRINCIPAIS ─────────────────────────────────────────────── --}}
        <div class="tabs-line d-flex gap-2">
            <button class="tab-btn active" data-tab="tab-visao">Visão Geral</button>
            <button class="tab-btn" data-tab="tab-catalogo">Catálogo
                <span class="badge-soft badge-info ms-1">{{ number_format($totalAtivos) }}</span>
            </button>
            <button class="tab-btn" data-tab="tab-historico">Histórico
                <span class="badge-soft badge-grey ms-1">{{ $totalSyncs }}</span>
            </button>
            <button class="tab-btn" data-tab="tab-logs">
                Logs de Erros
                @if($totalLinhasErro > 0)
                    <span class="badge-soft badge-err ms-1">{{ $totalLinhasErro }}</span>
                @endif
            </button>
        </div>

        {{-- ══════════════════ ABA: VISÃO GERAL ═══════════════════════════════ --}}
        <div class="tab-panel active" id="tab-visao">
            <div class="row g-3">
                {{-- Gráfico histórico de execuções --}}
                <div class="col-12 col-lg-8">
                    <div class="card-glass p-3 h-100">
                        <div class="section-hd mb-3">Kits Importados / Desativados por Execução</div>
                        <canvas id="chartHistorico" height="110"></canvas>
                    </div>
                </div>

                {{-- Detalhes da última sync --}}
                <div class="col-12 col-lg-4">
                    <div class="card-glass p-3 h-100">
                        <div class="section-hd mb-3">Última Sincronização</div>
                        @if($ultimaSync)
                            <table class="table table-sm mb-0">
                                <tbody>
                                    <tr><td class="text-muted" style="width:110px">Status</td>
                                        <td><span class="badge-soft {{ $ultimaSync->badge_class }}">{{ $ultimaSync->status }}</span></td></tr>
                                    <tr><td class="text-muted">Início</td><td>{{ $ultimaSync->data_inicio_fmt }}</td></tr>
                                    <tr><td class="text-muted">Fim</td><td>{{ $ultimaSync->data_fim_fmt }}</td></tr>
                                    <tr><td class="text-muted">Duração</td><td><strong>{{ $ultimaSync->duracao_fmt }}</strong></td></tr>
                                    <tr><td class="text-muted">Importados</td>
                                        <td><span class="fw-bold text-success">{{ number_format($ultimaSync->qtd_importados) }}</span></td></tr>
                                    <tr><td class="text-muted">Desativados</td>
                                        <td><span class="fw-bold text-danger">{{ number_format($ultimaSync->qtd_desativados) }}</span></td></tr>
                                    @if($ultimaSync->anotacoes)
                                    <tr><td class="text-muted">Erros</td>
                                        <td>
                                            <button class="btn-icon btn btn-sm" data-view-notes
                                                data-title="Notas da última sync"
                                                data-notes="{{ e($ultimaSync->anotacoes) }}">
                                                <i class="bi bi-exclamation-triangle text-warning"></i> Ver logs
                                            </button>
                                        </td></tr>
                                    @endif
                                </tbody>
                            </table>
                        @else
                            <div class="text-muted text-center py-4">Nenhuma execução registrada.</div>
                        @endif
                    </div>
                </div>

                {{-- Distribuição por potência --}}
                <div class="col-12 col-md-6">
                    <div class="card-glass p-3 h-100">
                        <div class="section-hd mb-3">Distribuição por Faixa de Potência</div>
                        @if(!empty($distribuicaoPotencia))
                            @php $maxPot = max($distribuicaoPotencia); @endphp
                            @foreach($distribuicaoPotencia as $faixa => $qtd)
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between mb-1" style="font-size:.82rem">
                                        <span class="fw-600">{{ $faixa }}</span>
                                        <span class="text-muted">{{ $qtd }} kits</span>
                                    </div>
                                    <div class="bar-wrap">
                                        <div class="bar-fill" style="width:{{ $maxPot > 0 ? round($qtd / $maxPot * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-muted text-center py-3">Sem dados.</div>
                        @endif
                    </div>
                </div>

                {{-- Distribuição Marcas --}}
                <div class="col-12 col-md-6">
                    <div class="card-glass p-3 h-100">
                        <div class="section-hd mb-3">Marcas de Inversores</div>
                        @if(!empty($distribuicaoMarcaInversor))
                            <canvas id="chartMarcaInversor" height="160"></canvas>
                        @else
                            <div class="text-muted text-center py-3">Sem dados.</div>
                        @endif
                    </div>
                </div>

                {{-- Distribuição Painéis --}}
                <div class="col-12 col-md-6">
                    <div class="card-glass p-3 h-100">
                        <div class="section-hd mb-3">Marcas de Painéis</div>
                        @if(!empty($distribuicaoMarcaPainel))
                            <canvas id="chartMarcaPainel" height="140"></canvas>
                        @else
                            <div class="text-muted text-center py-3">Sem dados.</div>
                        @endif
                    </div>
                </div>

                {{-- Distribuição Estrutura --}}
                <div class="col-12 col-md-6">
                    <div class="card-glass p-3 h-100">
                        <div class="section-hd mb-3">Tipos de Estrutura</div>
                        @if(!empty($distribuicaoEstrutura))
                            @php $maxEst = max($distribuicaoEstrutura); @endphp
                            @foreach($distribuicaoEstrutura as $nome => $qtd)
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between mb-1" style="font-size:.82rem">
                                        <span class="fw-600">{{ $nome }}</span>
                                        <span class="text-muted">{{ $qtd }}</span>
                                    </div>
                                    <div class="bar-wrap">
                                        <div class="bar-fill" style="width:{{ $maxEst > 0 ? round($qtd / $maxEst * 100) : 0 }}%; background:#6366f1"></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-muted text-center py-3">Sem dados.</div>
                        @endif
                    </div>
                </div>

                {{-- Informações do Fornecedor --}}
                <div class="col-12">
                    <div class="card-glass p-3">
                        <div class="section-hd mb-3">Informações do Fornecedor</div>
                        <div class="row g-2" style="font-size:.88rem">
                            <div class="col-md-3"><span class="text-muted">Nome:</span> <strong>EDELTEC</strong></div>
                            <div class="col-md-3"><span class="text-muted">CNPJ:</span> <strong>{{ $fornecedor?->cnpj ?? '—' }}</strong></div>
                            <div class="col-md-3"><span class="text-muted">Representante:</span> <strong>{{ $fornecedor?->representante ?? '—' }}</strong></div>
                            <div class="col-md-3"><span class="text-muted">E-mail:</span> <strong>{{ $fornecedor?->email ?? '—' }}</strong></div>
                            <div class="col-md-3"><span class="text-muted">Telefone:</span> <strong>{{ $fornecedor?->telefone ?? $fornecedor?->celular ?? '—' }}</strong></div>
                            <div class="col-md-3"><span class="text-muted">Site:</span>
                                @if($fornecedor?->site)
                                    <a href="{{ $fornecedor->site }}" target="_blank" rel="noopener">{{ $fornecedor->site }}</a>
                                @else <strong>—</strong> @endif
                            </div>
                            <div class="col-md-6"><span class="text-muted">Endpoint API:</span>
                                <code>https://api.edeltecsolar.com.br/api-access/token</code></div>
                            <div class="col-md-3"><span class="text-muted">Agendamento:</span>
                                <span class="badge-soft badge-info">Diário às 04:00h</span></div>
                            <div class="col-md-3"><span class="text-muted">Chave API:</span>
                                <code>c2ea3401-****-****-****-****</code> <small class="text-muted">(mascarada)</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════ ABA: CATÁLOGO ═══════════════════════════════════ --}}
        <div class="tab-panel" id="tab-catalogo">
            {{-- Filtros --}}
            <form method="GET" class="search-strip mb-3">
                <input type="hidden" name="tab" value="catalogo">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-1" style="font-size:.8rem;font-weight:700">Buscar SKU / Modelo / Marca</label>
                        <input type="text" name="q" class="form-control form-control-sm"
                               placeholder="Ex: GNW5000-3T, Growatt..." value="{{ $searchProduto }}">
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label mb-1" style="font-size:.8rem;font-weight:700">Potência mín (kWp)</label>
                        <input type="number" name="pot_min" class="form-control form-control-sm"
                               placeholder="Ex: 5" value="{{ $filtroPotMin }}" min="0" step="0.01">
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label mb-1" style="font-size:.8rem;font-weight:700">Potência máx (kWp)</label>
                        <input type="number" name="pot_max" class="form-control form-control-sm"
                               placeholder="Ex: 20" value="{{ $filtroPotMax }}" min="0" step="0.01">
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label mb-1" style="font-size:.8rem;font-weight:700">Status</label>
                        <select name="st" class="form-select form-select-sm">
                            <option value="ativos" {{ $filtroStatus === 'ativos' ? 'selected' : '' }}>Ativos</option>
                            <option value="inativos" {{ $filtroStatus === 'inativos' ? 'selected' : '' }}>Inativos</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                        <a href="{{ route('admin.integracoes.eldeltec.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x"></i>
                        </a>
                    </div>
                </div>
            </form>

            <div class="card-glass overflow-hidden">
                <div class="d-flex align-items-center justify-content-between px-3 pt-3 pb-2">
                    <div style="font-size:.88rem;color:var(--muted)">
                        <strong>{{ $produtos->total() }}</strong> produto(s) encontrado(s)
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Modelo</th>
                                <th class="text-center">Potência</th>
                                <th>Inversor</th>
                                <th>Painel</th>
                                <th>Estrutura</th>
                                <th class="text-center">Tensão</th>
                                <th class="text-end">Preço Forneced.</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Atualiz.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produtos as $p)
                                <tr>
                                    <td><code class="prod-sku">{{ $p->sku ?? '—' }}</code></td>
                                    <td>
                                        <div class="prod-name" style="max-width:220px">
                                            {{ Str::limit($p->modelo, 50) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-soft badge-info">{{ number_format($p->potencia_kit, 2) }} kWp</span>
                                    </td>
                                    <td style="font-size:.82rem">{{ $p->marca_inversor_nome ?? '—' }}</td>
                                    <td style="font-size:.82rem">{{ $p->marca_painel_nome ?? '—' }}</td>
                                    <td style="font-size:.82rem">{{ $p->estrutura_nome ?? '—' }}</td>
                                    <td class="text-center" style="font-size:.82rem">{{ $p->tensao ?? '—' }}V</td>
                                    <td class="text-end">
                                        <strong>R$ {{ number_format($p->preco_fornecedor, 2, ',', '.') }}</strong>
                                    </td>
                                    <td class="text-center">
                                        @if($p->status)
                                            <span class="badge-soft badge-ok">Ativo</span>
                                        @else
                                            <span class="badge-soft badge-err">Inativo</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="font-size:.78rem;color:var(--muted)">
                                        {{ $p->updated_at ? \Carbon\Carbon::parse($p->updated_at)->format('d/m/y') : '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:.5rem"></i>
                                        Nenhum produto encontrado com os filtros aplicados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-3">
                    {{ $produtos->withQueryString()->links() }}
                </div>
            </div>
        </div>

        {{-- ══════════════════ ABA: HISTÓRICO ══════════════════════════════════ --}}
        <div class="tab-panel" id="tab-historico">
            <div class="card-glass overflow-hidden">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Duração</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Importados</th>
                                <th class="text-center">Desativados</th>
                                <th>Erros</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($historicos as $h)
                                <tr>
                                    <td><strong>#{{ $h->id }}</strong></td>
                                    <td style="white-space:nowrap">{{ $h->data_inicio_fmt ?? '—' }}</td>
                                    <td style="white-space:nowrap">{{ $h->data_fim_fmt ?? '—' }}</td>
                                    <td><strong>{{ $h->duracao_fmt }}</strong></td>
                                    <td class="text-center">
                                        <span class="badge-soft {{ $h->badge_class }}">{{ $h->status ?? '—' }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($h->qtd_importados > 0)
                                            <span class="badge-soft badge-ok">{{ number_format($h->qtd_importados) }}</span>
                                        @else
                                            <span class="text-muted">0</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($h->qtd_desativados > 0)
                                            <span class="badge-soft badge-err">{{ number_format($h->qtd_desativados) }}</span>
                                        @else
                                            <span class="text-muted">0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($h->anotacoes)
                                            @php $nErros = substr_count($h->anotacoes, "\n") + 1; @endphp
                                            <span class="badge-soft badge-warn">{{ $nErros }} linha(s)</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            @if(count($h->importados) > 0)
                                                <button class="btn-icon btn btn-sm" data-view-list
                                                        data-title="SKUs Importados — Execução #{{ $h->id }}"
                                                        data-items="{{ e(json_encode($h->importados)) }}">
                                                    <i class="bi bi-box-seam"></i>
                                                </button>
                                            @endif
                                            @if(count($h->desativados) > 0)
                                                <button class="btn-icon btn btn-sm" data-view-list
                                                        data-title="SKUs Desativados — Execução #{{ $h->id }}"
                                                        data-items="{{ e(json_encode($h->desativados)) }}"
                                                        data-variant="danger">
                                                    <i class="bi bi-x-circle text-danger"></i>
                                                </button>
                                            @endif
                                            @if($h->anotacoes)
                                                <button class="btn-icon btn btn-sm" data-view-notes
                                                        data-title="Logs / Erros — Execução #{{ $h->id }}"
                                                        data-notes="{{ e($h->anotacoes) }}">
                                                    <i class="bi bi-journal-text text-warning"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-5">
                                        Nenhum histórico encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-3">
                    {{ $historicos->withQueryString()->links() }}
                </div>
            </div>
        </div>

        {{-- ══════════════════ ABA: LOGS DE ERROS ══════════════════════════════ --}}
        <div class="tab-panel" id="tab-logs">
            @if($logsErros->isEmpty())
                <div class="card-glass p-5 text-center text-muted">
                    <i class="bi bi-check-circle-fill text-success" style="font-size:2.5rem;display:block;margin-bottom:.75rem"></i>
                    <strong>Nenhum log de erro registrado.</strong><br>
                    Todas as execuções finalizaram sem anotações.
                </div>
            @else
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge-soft badge-err">{{ $totalLinhasErro }} linha(s) total</span>
                    <span class="text-muted" style="font-size:.85rem">em {{ $logsErros->count() }} execução(ões) com anotações</span>
                </div>
                <div class="d-flex flex-column gap-3">
                    @foreach($logsErros as $log)
                        <div class="card-glass p-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge-soft badge-grey">#{{ $log['id'] }}</span>
                                <span style="font-size:.82rem;color:var(--muted)">{{ $log['data'] }}</span>
                                <span class="badge-soft {{ str_contains(strtolower((string)$log['status']),'falh') ? 'badge-err' : (str_contains(strtolower((string)$log['status']),'conclu') ? 'badge-ok' : 'badge-warn') }}">
                                    {{ $log['status'] }}
                                </span>
                                <span class="ms-auto badge-soft badge-warn">{{ count($log['linhas']) }} linha(s)</span>
                            </div>
                            @foreach($log['linhas'] as $linha)
                                <div class="log-line">
                                    <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>{{ $linha }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </x-body>

    {{-- ── MODAL VIEWER ──────────────────────────────────────────────────── --}}
    <div class="modal fade" id="modalViewer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-800" id="modalViewerTitle">Detalhes</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalViewerBody">…</div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-outline-secondary btn-sm" id="btnCopyModal">
                        <i class="bi bi-clipboard"></i> Copiar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
        <script>
        (function(){
            // ── TABS ──────────────────────────────────────────────────────
            const tabBtns   = document.querySelectorAll('.tab-btn');
            const tabPanels = document.querySelectorAll('.tab-panel');

            function activateTab(tabId) {
                tabBtns.forEach(b => b.classList.toggle('active', b.dataset.tab === tabId));
                tabPanels.forEach(p => p.classList.toggle('active', p.id === tabId));
            }

            tabBtns.forEach(btn => btn.addEventListener('click', () => activateTab(btn.dataset.tab)));

            // Activa aba pela querystring (?tab=...)
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam  = urlParams.get('tab');
            if (tabParam) activateTab('tab-' + tabParam);

            // ── GRÁFICO HISTÓRICO ─────────────────────────────────────────
            const histData = @json($graficoHistorico);
            if (histData.length && document.getElementById('chartHistorico')) {
                new Chart(document.getElementById('chartHistorico'), {
                    type: 'bar',
                    data: {
                        labels: histData.map(d => d.label),
                        datasets: [
                            {
                                label: 'Importados',
                                data: histData.map(d => d.importados),
                                backgroundColor: histData.map(d => d.sucesso ? '#22c55e99' : '#f59e0b99'),
                                borderColor:     histData.map(d => d.sucesso ? '#16a34a' : '#d97706'),
                                borderWidth: 1.5, borderRadius: 4,
                            },
                            {
                                label: 'Desativados',
                                data: histData.map(d => d.desativados),
                                backgroundColor: '#ef444455',
                                borderColor: '#dc2626',
                                borderWidth: 1.5, borderRadius: 4,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { labels: { font: { weight: '700' } } } },
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                    }
                });
            }

            // ── GRÁFICO MARCAS INVERSOR ───────────────────────────────────
            const marcasInvData = @json($distribuicaoMarcaInversor);
            if (Object.keys(marcasInvData).length && document.getElementById('chartMarcaInversor')) {
                const colors = ['#6366f1','#06b6d4','#f59e0b','#22c55e','#ef4444','#8b5cf6','#0ea5e9','#10b981'];
                new Chart(document.getElementById('chartMarcaInversor'), {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(marcasInvData),
                        datasets: [{ data: Object.values(marcasInvData), backgroundColor: colors, borderWidth: 2 }]
                    },
                    options: { responsive: true, plugins: { legend: { position: 'right', labels: { font: { size: 11, weight: '700' } } } } }
                });
            }

            // ── GRÁFICO MARCAS PAINEL ─────────────────────────────────────
            const marcasPnlData = @json($distribuicaoMarcaPainel);
            if (Object.keys(marcasPnlData).length && document.getElementById('chartMarcaPainel')) {
                const colors2 = ['#0ea5e9','#f59e0b','#22c55e','#8b5cf6','#ef4444','#6366f1','#06b6d4','#10b981'];
                new Chart(document.getElementById('chartMarcaPainel'), {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(marcasPnlData),
                        datasets: [{ data: Object.values(marcasPnlData), backgroundColor: colors2, borderWidth: 2 }]
                    },
                    options: { responsive: true, plugins: { legend: { position: 'right', labels: { font: { size: 11, weight: '700' } } } } }
                });
            }

            // ── MODAL ─────────────────────────────────────────────────────
            const $modal  = $('#modalViewer');
            const $title  = $('#modalViewerTitle');
            const $body   = $('#modalViewerBody');
            let   _copyText = '';

            document.getElementById('btnCopyModal')?.addEventListener('click', () => {
                navigator.clipboard?.writeText(_copyText).then(() => alert('Copiado!'));
            });

            $(document).on('click','[data-view-list]', function(){
                const title = this.getAttribute('data-title') || 'Itens';
                const raw   = this.getAttribute('data-items') || '[]';
                let items   = [];
                try { items = JSON.parse(raw); } catch(e){ items = []; }
                _copyText   = items.join('\n');

                const isDanger = this.dataset.variant === 'danger';
                const html = items.length
                    ? `<div class="mb-2 text-muted" style="font-size:.82rem">${items.length} item(s)</div>
                       <div style="column-count:2;column-gap:1rem">` +
                      items.map(x => `<div style="font-family:monospace;font-size:.8rem;margin-bottom:.2rem;${isDanger ? 'color:#dc2626' : ''}">${String(x)}</div>`).join('') +
                      '</div>'
                    : '<div class="text-muted">Nada a exibir.</div>';

                $title.text(title);
                $body.html(html);
                $modal.modal('show');
            });

            $(document).on('click','[data-view-notes]', function(){
                const title = this.getAttribute('data-title') || 'Logs';
                const notes = this.getAttribute('data-notes') || '';
                _copyText   = notes;

                const linhas = notes.split('\n').filter(l => l.trim());
                const html = linhas.length
                    ? linhas.map(l => `<div class="log-line"><i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>${l}</div>`).join('')
                    : '<div class="text-muted">Sem anotações.</div>';

                $title.text(title);
                $body.html(html);
                $modal.modal('show');
            });
        })();
        </script>
    @endpush
</x-layout>
