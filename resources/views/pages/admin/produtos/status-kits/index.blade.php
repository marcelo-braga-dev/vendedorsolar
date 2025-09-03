<x-layout menu="kits_fv" submenu="kits_fv_status">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }

            /* ---------- Cards / util ---------- */
            .card-soft{ border:1px solid #eef2f6; border-radius:16px; box-shadow:0 8px 26px rgba(0,0,0,.04); background:#fff; }
            .card-body--tight{ padding:1rem 1.25rem; }
            .section-subtle{ font-size:.925rem; color:#6c757d; }
            .divider{ border-top:1px dashed #e9ecef; margin:1rem 0; }

            /* ---------- Fornecedores (chips com scroll e busca) ---------- */
            .nav-scroller{ position:relative; overflow-x:auto; overflow-y:hidden; }
            .nav-scroller .nav{ display:flex; flex-wrap:nowrap; white-space:nowrap; padding:.25rem 0; gap:.5rem; }

            .supplier-chip{
                display:inline-flex; align-items:center; justify-content:center;
                height:36px; padding:0 .9rem;
                border-radius:999px; border:1px solid #dee2e6; background:#fff; color:#495057;
                transition:all .2s ease; white-space:nowrap;
            }
            .supplier-chip:hover{ background:#f8f9fa; text-decoration:none; }
            .supplier-chip.active{
                background:var(--brand); color:#fff !important; border-color:var(--brand);
                box-shadow:0 0 0 .18rem rgba(226,85,7,.20);
            }
            .supplier-filter{ max-width:280px; border-radius:999px; }

            /* ---------- Layout 2 colunas ---------- */
            @media (min-width:768px){
                .layout-cols{ display:flex; gap:1rem; }
                .layout-left{ flex:0 0 42%; max-width:42%; padding-right:.5rem; border-right:1px solid #edf2f7; }
                .layout-right{ flex:1; padding-left:.5rem; }
            }
            @media (max-width:767.98px){ .layout-left{ margin-bottom:.75rem; } }
            .sidebar-sticky{ position:sticky; top:1rem; }

            /* ---------- Abas (inversores) à esquerda ---------- */
            #tabs-inversores{ margin:0; }
            #tabs-inversores .nav-item{ width:100%; }
            #tabs-inversores .nav-link{
                display:flex; align-items:center; justify-content:space-between; gap:.75rem;
                height:44px; padding:0 .9rem; margin-bottom:.55rem;
                border-radius:.65rem; font-weight:700; letter-spacing:.2px;
                color:#495057; background:#fff; border:1px solid #e9ecef;
                transition:all .2s ease; text-align:left;
            }
            #tabs-inversores .nav-link:hover{ background:#f8f9fa; }
            #tabs-inversores .nav-link .chev{ color:#9aa0a6; transition:transform .2s ease; }
            #tabs-inversores .nav-link.active{
                background:var(--brand-050); color:#212529; border-color:var(--brand-200);
                box-shadow:0 0 0 .18rem rgba(226,85,7,.14);
            }
            #tabs-inversores .nav-link.active .chev{ transform:rotate(90deg); color:var(--brand-700); }

            /* ---------- Sub-abas (marcas dos painéis) à direita ---------- */
            .right-head{ position:sticky; top:1rem; background:#fff; z-index:1; padding-bottom:.5rem; border-bottom:1px solid #f1f3f5; }
            .brand-pair img{ height:36px; object-fit:contain; }
            .brand-pair small{ color:#6c757d; }

            .nav-painel{ display:flex; flex-wrap:wrap; gap:.5rem; }
            .nav-painel .nav-link{
                display:inline-flex; align-items:center; justify-content:center; gap:.5rem;
                height:36px; padding:0 .9rem;
                border-radius:999px; border:1px solid #e9ecef; background:#fff; color:#495057;
                transition:all .2s ease; font-weight:700;
            }
            .nav-painel .nav-link:hover{ background:#f8f9fa; }
            .nav-painel .nav-link.active{
                background:var(--brand); color:#fff; border-color:var(--brand);
                box-shadow:0 0 0 .16rem rgba(226,85,7,.18);
            }

            /* ---------- Lista de potências ---------- */
            .power-list .power-row{
                display:flex; align-items:center; justify-content:space-between; gap:1rem;
                padding:.7rem .5rem; border-top:1px dashed #e9ecef; border-radius:10px;
                transition: background .15s ease, box-shadow .15s ease;
            }
            .power-list .power-row:first-child{ border-top:0; }
            .power-list .power-row:hover{ background:#fcfdfd; box-shadow: inset 0 0 0 1px #f3f4f6; }
            .power-meta{ display:flex; align-items:center; gap:.5rem; }
            .power-meta .badge{ font-weight:700; letter-spacing:.2px; }
            .badge-soft{ border-radius:999px; padding:.28rem .55rem; font-size:.72rem; font-weight:700; border:1px solid transparent; }
            .badge-on{ background: rgba(25,135,84,.1); color:#198754; border-color: rgba(25,135,84,.25); }
            .badge-off{ background: rgba(220,53,69,.1); color:#dc3545; border-color: rgba(220,53,69,.25); }

            /* ---------- Switch custom (BS5) ---------- */
            .form-check.form-switch .form-check-input{ width: 3rem; height:1.5rem; }
            .form-check-input:focus{ box-shadow:0 0 0 .2rem rgba(226,85,7,.18); }
            .form-check-input:checked{ background-color:var(--brand); border-color:var(--brand); }
        </style>
    @endpush>

    <x-layout.container title="Alterar Status dos Kits do Fornecedor">
        {{-- Fornecedores como chips + busca --}}
        <div class="card card-soft mb-3">
            <div class="card-body card-body--tight">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                    <h3 class="h6 mb-0">Fornecedores</h3>
                    <div class="ms-auto">
                        <input type="text" class="form-control form-control-sm supplier-filter"
                               placeholder="Filtrar fornecedores..." id="supplierFilter">
                    </div>
                </div>

                <div class="nav-scroller">
                    <div class="nav" id="supplierChips">
                        @foreach($fornecedores as $item)
                            <a class="supplier-chip {{ $item->id == $fornecedor ? 'active' : '' }}"
                               href="{{ route('admin.produtos.status-kits.index', ['id' => $item->id]) }}"
                               data-name="{{ mb_strtolower($item->nome, 'UTF-8') }}">
                                {{ $item->nome }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" id="fornecedor" value="{{ $fornecedor }}">
            </div>
        </div>

        {{-- Bloco principal (inversores x painéis) --}}
        <div class="card card-soft">
            <div class="card-body">
                {{-- legenda / ajuda --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge-soft badge-on"><i class="fas fa-check-circle"></i> Ativo</span>
                        <span class="badge-soft badge-off"><i class="fas fa-times-circle"></i> Inativo</span>
                        <span class="badge-soft" style="background:var(--brand-100); color:var(--brand-700); border-color:var(--brand-200);">
                            <i class="fas fa-bolt"></i> Potência
                        </span>
                    </div>
                    <small class="text-muted">Fornecedor atual: <strong>{{ $nomeFornecedor }}</strong></small>
                </div>

                <div class="layout-cols">
                    {{-- Esquerda: abas de inversores --}}
                    <div class="layout-left">
                        <div class="sidebar-sticky">
                            <h3 class="h6 text-uppercase text-muted mb-2">Marcas dos Inversores</h3>

                            <ul class="nav flex-column" id="tabs-inversores" role="tablist" aria-label="Abas de marcas de inversores">
                                @foreach($kits as $index => $inversores)
                                    @php
                                        $invTabId  = "tab-inv-{$index}";
                                        $invPaneId = "pane-inv-{$index}";
                                        $isActive  = $loop->first;
                                    @endphp
                                    <li class="nav-item">
                                        <a  class="nav-link {{ $isActive ? 'active' : '' }}"
                                            id="{{ $invTabId }}"
                                            data-bs-toggle="tab"
                                            href="#{{ $invPaneId }}"
                                            role="tab"
                                            aria-controls="{{ $invPaneId }}"
                                            aria-selected="{{ $isActive ? 'true' : 'false' }}">
                                            <span>{{ $marcas[$index]['nome'] }}</span>
                                            <i class="fas fa-angle-right chev"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Direita: conteúdo por inversor --}}
                    <div class="layout-right">
                        <div class="tab-content" id="tabs-inversores-content">
                            @foreach($kits as $indexInversor => $inversores)
                                @php
                                    $invPaneId = "pane-inv-{$indexInversor}";
                                    $invTabId  = "tab-inv-{$indexInversor}";
                                    $invActive = $loop->first ? 'show active' : '';
                                @endphp

                                <div class="tab-pane fade {{ $invActive }}" id="{{ $invPaneId }}" role="tabpanel" aria-labelledby="{{ $invTabId }}">
                                    <div class="right-head mb-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                            <div>
                                                <h3 class="h6 mb-1">Marcas dos Painéis</h3>
                                                <div class="section-subtle">Selecione a combinação de marcas para ajustar os status de potência.</div>
                                            </div>
                                            <div class="brand-pair text-center">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div>
                                                        <img src="{{ asset('storage').'/'.$marcas[$indexInversor]['logo'] }}" alt="Inversor">
                                                        <small class="d-block">Inversor</small>
                                                    </div>
                                                    <i class="fas fa-times text-muted"></i>
                                                    {{-- o logo do painel aparece em cada sub-aba abaixo --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Sub-abas (marcas dos painéis) --}}
                                        <div class="col-12">
                                            <div class="nav nav-painel" id="v-pills-{{ $indexInversor }}" role="tablist" aria-orientation="horizontal" aria-label="Abas de marcas de painéis">
                                                @foreach($inversores as $indexPaineis => $paineis)
                                                    @php
                                                        $painelTabId  = "v-tab-{$indexInversor}-{$indexPaineis}";
                                                        $painelPaneId = "v-pane-{$indexInversor}-{$indexPaineis}";
                                                        $isActive     = $loop->first;
                                                    @endphp
                                                    <a  class="nav-link {{ $isActive ? 'active' : '' }}"
                                                        id="{{ $painelTabId }}"
                                                        data-bs-toggle="pill"
                                                        href="#{{ $painelPaneId }}"
                                                        role="tab"
                                                        aria-controls="{{ $painelPaneId }}"
                                                        aria-selected="{{ $isActive ? 'true' : 'false' }}">
                                                        <i class="fas fa-solar-panel"></i> {{ $marcas[$indexPaineis]['nome'] }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Conteúdo de cada painel --}}
                                        <div class="col-12 mt-3">
                                            <div class="tab-content" id="v-pills-content-{{ $indexInversor }}">
                                                @foreach($inversores as $indexPaineis => $paineis)
                                                    @php
                                                        $painelPaneId = "v-pane-{$indexInversor}-{$indexPaineis}";
                                                        $painelTabId  = "v-tab-{$indexInversor}-{$indexPaineis}";
                                                        $paneActive   = $loop->first ? 'show active' : '';
                                                    @endphp
                                                    <div class="tab-pane fade {{ $paneActive }}" id="{{ $painelPaneId }}" role="tabpanel" aria-labelledby="{{ $painelTabId }}">

                                                        {{-- Header da combinação (logo do painel) --}}
                                                        <div class="d-flex align-items-center justify-content-end mb-2">
                                                            <div class="text-center">
                                                                <img src="{{ asset('storage').'/'.$marcas[$indexPaineis]['logo'] }}" alt="Painel" style="height:36px; object-fit:contain;">
                                                                <small class="d-block text-muted">Painel</small>
                                                            </div>
                                                        </div>

                                                        {{-- Lista de potências --}}
                                                        <div class="power-list">
                                                            @foreach($paineis as $painel)
                                                                @php $ativo = (bool) $painel->status; @endphp
                                                                <div class="power-row">
                                                                    <div class="power-meta">
                                                                        <span class="badge badge-soft {{ $ativo ? 'badge-on' : 'badge-off' }}">
                                                                            {{ $ativo ? 'Ativo' : 'Inativo' }}
                                                                        </span>
                                                                        <span class="fw-semibold">{{ $painel->potencia_painel }} W</span>
                                                                    </div>

                                                                    {{-- Switch (BS5) --}}
                                                                    <div class="form-check form-switch m-0" data-bs-toggle="tooltip"
                                                                         data-bs-title="{{ $ativo ? 'Desativar potência' : 'Ativar potência' }}">
                                                                        <input class="form-check-input mudar-status"
                                                                               type="checkbox" role="switch"
                                                                               inversor="{{ $indexInversor }}"
                                                                               painel="{{ $indexPaineis }}"
                                                                               potencia="{{ $painel->potencia_painel }}"
                                                                               @if($ativo) checked @endif>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div> {{-- /row --}}
                                </div>
                            @endforeach
                        </div> {{-- /tab-content inversores --}}
                    </div>
                </div>
            </div>
        </div>
    </x-layout.container>

    @push('js')
        <script>
            (function(){
                // helper: carrega script se faltar
                function loadScript(src, cb){
                    var s=document.createElement('script');
                    s.src=src; s.onload=cb; s.async=true; document.head.appendChild(s);
                }

                // inicializações (dependem de Bootstrap 5)
                function initBootstrapFeatures(scope=document){
                    // Abas: garantir instância e comportamento
                    scope.querySelectorAll('[data-bs-toggle="tab"], [data-bs-toggle="pill"]').forEach(function(trig){
                        if(!window.bootstrap) return;
                        if(!bootstrap.Tab.getInstance(trig)) new bootstrap.Tab(trig);
                        trig.addEventListener('click', function(e){
                            e.preventDefault();
                            bootstrap.Tab.getOrCreateInstance(trig).show();
                        }, {once:false});
                    });

                    // Tooltips
                    if (window.bootstrap) {
                        scope.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el){
                            if (!bootstrap.Tooltip.getInstance(el)) new bootstrap.Tooltip(el);
                        });
                    }
                }

                // Sempre inicializa jQuery listeners já
                $(function () {
                    // Filtro fornecedores
                    $('#supplierFilter').on('input', function(){
                        const q = $(this).val().toLowerCase().trim();
                        $('#supplierChips .supplier-chip').each(function(){
                            const name = (this.dataset.name || '').toLowerCase();
                            $(this).toggle(name.indexOf(q) !== -1);
                        });
                    });

                    // Delegação: switches
                    $(document).on('change', '.mudar-status', function () {
                        const fornecedor = $('#fornecedor').val();
                        const inversor   = $(this).attr('inversor');
                        const painel     = $(this).attr('painel');
                        const potencia   = $(this).attr('potencia');
                        const status     = $(this).is(':checked');

                        $.ajax({
                            url: "{{ route('admin.produtos.alterar-status-kits') }}",
                            method: "GET",
                            dataType: "json",
                            data: { fornecedor, inversor, painel, potencia, status },
                        }).fail(function(){
                            // Reverte se deu erro
                            const $el = $('.mudar-status[inversor="'+inversor+'"][painel="'+painel+'"][potencia="'+potencia+'"]');
                            $el.prop('checked', !status);
                            alert('Não foi possível alterar o status agora.');
                        });
                    });
                });

                // Se Bootstrap 5 não estiver presente, carrega o bundle do CDN
                function ensureBootstrapAndInit(){
                    if (!window.bootstrap) {
                        loadScript('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', function(){
                            initBootstrapFeatures(document);
                            // reinit ao mostrar abas
                            document.addEventListener('shown.bs.tab', function(e){
                                const target = document.querySelector(e.target.getAttribute('href'));
                                if (target) initBootstrapFeatures(target);
                            }, true);
                        });
                    } else {
                        initBootstrapFeatures(document);
                        document.addEventListener('shown.bs.tab', function(e){
                            const target = document.querySelector(e.target.getAttribute('href'));
                            if (target) initBootstrapFeatures(target);
                        }, true);
                    }
                }

                // dispara agora
                ensureBootstrapAndInit();
            })();
        </script>
    @endpush
</x-layout>
