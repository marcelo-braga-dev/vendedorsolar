<x-layout menu="home" submenu="home">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06;
                --ink:#0f172a; --muted:#64748b; --line:#e5e7eb; --soft:#f8fafc;
            }
            .section-title{font-weight:800;color:var(--ink);font-size:1.05rem}
            .card-soft{border:1px solid #eef2f6;border-radius:16px;background:#fff}
            .card-soft .hd{padding:.9rem 1rem;border-bottom:1px solid #f1f5f9;font-weight:800;color:#0f172a}
            .card-soft .bd{padding:1rem}

            /* KPIs */
            .kpi{display:flex;align-items:center;gap:.9rem;padding:1rem}
            .kpi+.kpi{border-top:1px dashed #eef2f6}
            .kpi .ico{width:38px;height:38px;display:grid;place-items:center;border-radius:12px;background:#fff;border:1px solid #f1f5f9}
            .kpi .ico .bi{font-size:18px;color:var(--brand)}
            .kpi .txt small{display:block;color:var(--muted);font-weight:700;letter-spacing:.02em}
            .kpi .txt .val{font-weight:900;font-size:1.25rem;color:#0b132b}

            /* quick actions */
            .qa .btn{display:flex;align-items:center;gap:.5rem;font-weight:700;border-radius:12px; margin-bottom: 15px}
            .btn-brand{background:var(--brand);border-color:var(--brand);color:#fff}
            .btn-brand:hover{background:var(--brand-600);border-color:var(--brand-600);color:#fff}
            .btn-outline{border:1px solid var(--line);background:#fff;color:#0f172a}
            .btn-outline:hover{border-color:#dfe3ea;background:#fff}

            /* listinhas */
            .list-mini{margin:0;padding:0;list-style:none}
            .list-mini li{display:flex;align-items:center;gap:.6rem;padding:.55rem .25rem;border-bottom:1px dashed #eef2f6}
            .list-mini li:last-child{border-bottom:0}
            .chip{border:1px solid #ffd9c6;background:#fff;border-radius:999px;padding:.15rem .5rem;font-size:.78rem;font-weight:800;color:#a34715}

            /* empty */
            .empty{display:flex;align-items:center;gap:.6rem;color:var(--muted)}

            /* hero */
            .hero{border:1px solid #eef2f6;border-radius:16px;background:#fff;padding:1rem 1.25rem}
            .hero h3{margin:0;font-weight:900;color:#0f172a}
            .hero p{margin:0;color:var(--muted)}
        </style>
    @endpush

    <x-layout.container>
        {{-- HERO / Cabeçalho --}}
        <div class="hero mb-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <h3>Bem-vindo{{ auth()->user()?->name ? ', ' . e(auth()->user()->name) : '' }}!</h3>
                </div>
                <img src="{{ getLogoPrincipal() }}" alt="Logo" height="46">
            </div>
        </div>

        <div class="row g-3">
            {{-- COL ESQ: KPIs + Ações Rápidas --}}
            <div class="col-12 col-lg-4">
                <div class="card-soft mb-3">
                    <div class="hd">Resumo</div>
                    <div class="bd p-0">
                        <div class="kpi">
                            <div class="ico"><i class="bi bi-people"></i></div>
                            <div class="txt">
                                <small>Clientes</small>
                                <div class="val js-count" data-val="{{ $totalClientes ?? 0 }}">{{ $totalClientes ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="kpi">
                            <div class="ico"><i class="bi bi-file-earmark-text"></i></div>
                            <div class="txt">
                                <small>Orçamentos Abertos</small>
                                <div class="val js-count" data-val="{{ $orcamentosAbertos ?? 0 }}">{{ $orcamentosAbertos ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="kpi">
                            <div class="ico"><i class="bi bi-archive"></i></div>
                            <div class="txt">
                                <small>Contratos Ativos</small>
                                <div class="val js-count" data-val="{{ $contratosAtivos ?? 0 }}">{{ $contratosAtivos ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="kpi">
                            <div class="ico"><i class="bi bi-chat-dots"></i></div>
                            <div class="txt">
                                <small>Mensagens por ler</small>
                                <div class="val js-count" data-val="{{ $avisosNaoLidos ?? 0 }}">{{ $avisosNaoLidos ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-soft mb-3">
                    <div class="hd">Ações rápidas</div>
                    <div class="bd">
                        <div class="qa d-grid gap-2">
                            <a class="btn btn-outline" href="{{ route('vendedor.dimensionamento.convencional.index') }}">
                                <i class="bi bi-lightning-charge"></i> Gerar Proposta (Convencional)
                            </a>
                            <a class="btn btn-outline" href="{{ route('vendedor.dimensionamento.demanda.index') }}">
                                <i class="bi bi-graph-up-arrow"></i> Gerar Proposta (Demanda)
                            </a>
                            <a class="btn btn-outline" href="{{ route('vendedor.servicos.create') }}">
                                <i class="bi bi-briefcase"></i> Proposta de Serviços
                            </a>
                            <a class="btn btn-outline" href="{{ route('vendedor.clientes.create') }}">
                                <i class="bi bi-person-plus"></i> Cadastrar Cliente
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COL MEIO: Últimos Orçamentos --}}
            <div class="col-12 col-lg-4">
                <div class="card-soft h-100">
                    <div class="hd d-flex align-items-center justify-content-between">
                        <span>Últimos Orçamentos</span>
                        <a href="{{ route('vendedor.orcamento.index') }}" class="text-decoration-none" style="font-weight:700;color:var(--brand)">ver todos</a>
                    </div>
                    <div class="bd">
                        @php($orcamentos = $orcamentosRecentes ?? [])
                        @if(!empty($orcamentos))
                            <ul class="list-mini">
                                @foreach($orcamentos as $o)
                                    <li>
                                        <i class="bi bi-sun text-warning"></i>
                                        <div class="flex-grow-1">
                                            <div style="font-weight:700;color:#0b132b">
                                                #{{ $o->id }} — {{ Str::limit($o->cliente_nome ?? $o->cliente->nome ?? $o->cliente->razao_social ?? 'Cliente', 28) }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($o->created_at)->format('d/m/Y') }}
                                                · {{ $o->status_label ?? ucfirst($o->status ?? 'pendente') }}
                                            </small>
                                        </div>
                                        @if(isset($o->valor))
                                            <span class="chip">R$ {{ convert_float_money($o->valor) }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty"><i class="bi bi-inbox"></i> Sem orçamentos recentes.</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- COL DIR: Avisos / Conversas --}}
            <div class="col-12 col-lg-4">
                <div class="card-soft mb-3">
                    <div class="hd d-flex align-items-center justify-content-between">
                        <span>Avisos</span>
                        <a href="{{ route('vendedor.alertas.index') }}" class="text-decoration-none" style="font-weight:700;color:var(--brand)">ver todos</a>
                    </div>
                    <div class="bd">
                        @php($avisos = $avisosRecentes ?? [])
                        @if(!empty($avisos))
                            <ul class="list-mini">
                                @foreach($avisos as $a)
                                    <li>
                                        <i class="bi bi-megaphone text-danger"></i>
                                        <div class="flex-grow-1">
                                            <div style="font-weight:700;color:#0b132b">{{ Str::limit($a->titulo ?? 'Aviso', 36) }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($a->created_at)->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty"><i class="bi bi-inbox"></i> Nenhum aviso por enquanto.</div>
                        @endif
                    </div>
                </div>

                <div class="card-soft">
                    <div class="hd d-flex align-items-center justify-content-between">
                        <span>Conversas</span>
                        <a href="{{ route('vendedor.mensagens.index') }}" class="text-decoration-none" style="font-weight:700;color:var(--brand)">abrir chat</a>
                    </div>
                    <div class="bd">
                        @php($conversas = $conversasRecentes ?? [])
                        @if(!empty($conversas))
                            <ul class="list-mini">
                                @foreach($conversas as $c)
                                    <li>
                                        <i class="bi bi-chat-dots text-primary"></i>
                                        <div class="flex-grow-1">
                                            <div style="font-weight:700;color:#0b132b">{{ Str::limit($c->titulo ?? ($c->cliente_nome ?? 'Conversa'), 36) }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($c->updated_at ?? $c->created_at)->diffForHumans() }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty"><i class="bi bi-inbox"></i> Sem conversas recentes.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Linha de atalhos (cards simples) --}}
        <div class="row g-3 mt-3">
            <div class="col-12 col-md-4">
                <div class="card-soft">
                    <div class="bd d-flex align-items-center justify-content-between">
                        <div>
                            <div class="section-title mb-1"><i class="bi bi-calendar-check me-1"></i> Próximas Visitas</div>
                            <div class="text-muted">
                                {{ ($visitasProximas ?? 0) > 0 ? ($visitasProximas.' agendada(s)') : 'Nenhuma visita agendada' }}
                            </div>
                        </div>
                        <a href="{{ route('vendedor.visitas.index') }}" class="btn btn-outline btn-sm">Ver</a>
                    </div>
                </div>
            </div>
            @if (implementadoContratos())
                <div class="col-12 col-md-4">
                    <div class="card-soft">
                        <div class="bd d-flex align-items-center justify-content-between">
                            <div>
                                <div class="section-title mb-1"><i class="bi bi-archive me-1"></i> Contratos</div>
                                <div class="text-muted">{{ $contratosAtivos ?? 0 }} ativo(s)</div>
                            </div>
                            <a href="{{ route('vendedor.contratos.index') }}" class="btn btn-outline btn-sm">Abrir</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12 col-md-4">
                <div class="card-soft">
                    <div class="bd d-flex align-items-center justify-content-between">
                        <div>
                            <div class="section-title mb-1"><i class="bi bi-people me-1"></i> Clientes</div>
                            <div class="text-muted">{{ $totalClientes ?? 0 }} cliente(s)</div>
                        </div>
                        <a href="{{ route('vendedor.clientes.index') }}" class="btn btn-outline btn-sm">Listar</a>
                    </div>
                </div>
            </div>
        </div>

        @push('js')
            <script>
                // contador simples e suave para os KPIs (quando números são passados)
                (function(){
                    const els = document.querySelectorAll('.js-count[data-val]');
                    els.forEach(el=>{
                        const target = parseInt(el.getAttribute('data-val')) || 0;
                        if(!target){ el.textContent = '0'; return; }
                        let cur = 0, step = Math.ceil(target/24);
                        const tick = () => {
                            cur = Math.min(cur + step, target);
                            el.textContent = cur.toLocaleString('pt-BR');
                            if(cur < target) requestAnimationFrame(tick);
                        };
                        requestAnimationFrame(tick);
                    });
                })();
            </script>
        @endpush
    </x-layout.container>
</x-layout>
