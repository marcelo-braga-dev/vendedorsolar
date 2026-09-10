<x-layout menu="kits_fv" submenu="kits_fv_cadastrados">
    @push('css')
        <style>
            /* ====== Filtros ====== */
            .card-soft {
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 8px 26px rgba(0, 0, 0, .04);
            }

            .filter-actions {
                text-align: center;
            }

            .chip {
                display: inline-flex;
                align-items: center;
                gap: .35rem;
                height: 32px;
                padding: 0 .75rem;
                border: 1px solid #e7eaef;
                background: #fff;
                color: #495057;
                border-radius: 999px;
                font-weight: 600;
                font-size: .85rem;
                transition: all .2s ease;
            }

            .chip:hover {
                background: #f8f9fb;
                text-decoration: none;
            }

            .chip .dot {
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: #adb5bd;
            }

            .chip.active {
                border-color: var(--brand);
                color: var(--brand-700);
                background: var(--brand-100);
            }

            .chip.active .dot {
                background: var(--brand);
            }

            /* ====== Cards dos kits ====== */
            .kit-card {
                border-radius: 16px;
                border: 1px solid #eef2f6;
                overflow: hidden;
                background: #fff;
            }

            .kit-card:hover {
                box-shadow: 0 16px 40px rgba(0, 0, 0, .06);
                transform: translateY(-2px);
                transition: .18s ease;
            }

            .kit-card-inner {
                display: flex;
                align-items: stretch;
            }

            /* ---- Bloco de imagens: foto + logo de cada componente (mesmas
               imagens cadastradas em admin/produtos/inversores e /paineis,
               e usadas nas propostas em PDF). Empilhado verticalmente para
               dar altura de verdade a cada foto, em vez de espremer as duas
               lado a lado numa coluna estreita. ---- */
            .kit-media {
                flex: 0 0 230px;
                max-width: 230px;
                padding: 1.5rem 1.25rem;
                background: #fafbfc;
                border-left: 1px solid #eef2f6;
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 1.1rem;
            }

            .component-card {
                background: #fff;
                border: 1px solid #eef2f6;
                border-radius: 14px;
                padding: 1rem .9rem .8rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: .65rem;
            }

            .component-photo {
                width: 100%;
                height: 130px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }

            .component-photo img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .component-photo .no-photo {
                color: #d5dae0;
                font-size: 2rem;
            }

            .component-logo {
                width: 100%;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: .55rem;
                border-top: 1px dashed #eef2f6;
            }

            .component-logo img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }

            .component-label {
                font-size: .66rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .4px;
                color: #8891a0;
            }

            .kit-content {
                flex: 1;
                min-width: 0;
                padding: 1.5rem 1.75rem;
            }

            @media (max-width: 767.98px) {
                .kit-card-inner {
                    flex-direction: column;
                }

                .kit-media {
                    order: -1;
                    flex: none;
                    max-width: none;
                    flex-direction: row;
                    border-left: 0;
                    border-bottom: 1px solid #eef2f6;
                    padding: 1.25rem;
                }

                .component-card {
                    flex: 1 1 0;
                    min-width: 0;
                }

                .component-photo {
                    height: 100px;
                }

                .kit-content {
                    padding: 1.25rem;
                }
            }

            .kit-head {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .kit-title {
                margin: .35rem 0 0;
                font-weight: 800;
                letter-spacing: .2px;
            }

            .kit-subtitle {
                margin-top: .2rem;
                font-size: .82rem;
                color: #8891a0;
                display: flex;
                align-items: center;
                gap: .4rem;
            }

            .kit-subtitle .mono {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            }

            .kit-subtitle .dot-sep {
                color: #dee2e6;
            }

            .badges {
                display: flex;
                gap: .4rem;
                flex-wrap: wrap;
            }

            .badge-soft {
                border-radius: 999px;
                padding: .35rem .6rem;
                font-weight: 700;
                font-size: .72rem;
                border: 1px solid transparent;
            }

            .badge-status-on {
                background: rgba(25, 135, 84, .1);
                color: #198754;
                border-color: rgba(25, 135, 84, .2);
            }

            .badge-status-off {
                background: rgba(220, 53, 69, .1);
                color: #dc3545;
                border-color: rgba(220, 53, 69, .2);
            }

            .badge-sku {
                background: var(--brand-100);
                color: var(--brand-700);
                border-color: var(--brand-200);
            }

            .badge-categoria {
                background: #eef2f7;
                color: #495057;
                border-color: #e2e8f0;
            }

            .divider {
                border-top: 1px dashed #e9ecef;
                margin: 1.1rem 0;
            }

            /* ---- Linha de destaque (potência / preço / margem) ---- */
            .kit-stats {
                display: flex;
                gap: .75rem;
                flex-wrap: wrap;
            }

            .stat-block {
                flex: 1 1 150px;
                background: #f8f9fb;
                border: 1px solid #eef2f6;
                border-radius: 12px;
                padding: .65rem .9rem;
                display: flex;
                flex-direction: column;
                gap: .15rem;
            }

            .stat-block--primary {
                background: var(--brand-100);
                border-color: var(--brand-200);
            }

            .stat-label {
                font-size: .68rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .3px;
                color: #8891a0;
            }

            .stat-value {
                font-size: 1.3rem;
                font-weight: 800;
                color: #212529;
                line-height: 1.2;
            }

            .stat-block--primary .stat-value {
                color: var(--brand-700);
            }

            .stat-value small {
                font-size: .7rem;
                font-weight: 700;
                color: #8891a0;
                margin-left: .15rem;
            }

            /* ---- Colunas de informação (componentes / especificações / comercial) ---- */
            .info-group-title {
                display: flex;
                align-items: center;
                gap: .45rem;
                font-size: .78rem;
                font-weight: 700;
                color: #495057;
                text-transform: uppercase;
                letter-spacing: .2px;
                margin-bottom: .55rem;
            }

            .info-group-title i {
                color: var(--brand);
                width: 16px;
                text-align: center;
            }

            .info-row {
                display: flex;
                align-items: baseline;
                justify-content: space-between;
                gap: .75rem;
                padding: .32rem 0;
                border-bottom: 1px dashed #f1f3f5;
                font-size: .88rem;
            }

            .info-row:last-child {
                border-bottom: 0;
            }

            .info-row .label {
                color: #8891a0;
                white-space: nowrap;
            }

            .info-row .value {
                font-weight: 600;
                text-align: right;
                color: #343a40;
            }

            /* ações */
            .btn-kit-edit {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                background: var(--brand);
                border: 1px solid var(--brand);
                color: #fff;
                border-radius: 10px;
                padding: .5rem 1rem;
                font-weight: 700;
                white-space: nowrap;
            }

            .btn-kit-edit:hover {
                background: var(--brand-600);
                border-color: var(--brand-600);
                color: #fff;
                text-decoration: none;
            }

            .kit-footer-meta {
                font-size: .78rem;
                color: #adb5bd;
                display: flex;
                align-items: center;
                gap: .4rem;
            }

            /* responsividade dos blocos */
            @media (max-width: 991.98px) {
                .kit-columns > [class^="col-"] + [class^="col-"] {
                    margin-top: .75rem;
                }

                .meta .label {
                    min-width: 110px;
                }
            }
        </style>
    @endpush

    <x-body title="Kits Fotovoltaicos Cadastrados" class="p-0">
        <div class="px-3 pt-3 pb-1">
            <form>
                <div class="filter-head mb-3">
                    <h2 class="h6 mb-0">Filtros</h2>
                    <small class="text-muted">Mostrando {{ $kits->total() }} kits</small>
                </div>

                {{-- Chips rápidos (exemplos: status) --}}
                <div class="mb-3 d-flex flex-wrap gap-2">
                    @php
                        $ativado      = ($request->status ?? '0') === '2';
                        $desativado   = ($request->status ?? '0') === '1';
                        $todosStatus  = ($request->status ?? '0') === '0';
                    @endphp
                    <a href="?status=0" class="chip mr-2 {{ $todosStatus ? 'active':'' }}"><span class="dot"></span> Todos</a>
                    <a href="?status=2" class="chip mr-2 {{ $ativado ? 'active':'' }}"><span class="dot"></span> Ativados</a>
                    <a href="?status=1" class="chip mr-2 {{ $desativado ? 'active':'' }}"><span class="dot"></span> Desativados</a>
                </div>

                {{-- Linha 1 --}}
                <div class="row g-3">
                    <div class="col-6 col-md-2">
                        <x-inputs.input label="ID do Kit" name="id" type="number"
                                        value="{{ $request->id }}" placeholder="#000"></x-inputs.input>
                    </div>
                    <div class="col-6 col-md-2">
                        <x-inputs.input label="Código" name="codigo" type="text"
                                        value="{{ $request->codigo }}"></x-inputs.input>
                    </div>
                    <div class="col-12 col-md-4">
                        <x-inputs.select name="estrutura" label="Estrutura">
                            <option value="0">Todos</option>
                            @foreach(getEstruturas() as $estrutura)
                                <option value="{{ $estrutura->id }}"
                                        @if ($estrutura->id == $request->estrutura) selected @endif>
                                    {{ $estrutura->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-12 col-md-4">
                        <x-inputs.select name="fornecedor" label="Fornecedor">
                            <option value="0">Todos</option>
                            @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}"
                                        @if ($fornecedor->id == $request->fornecedor) selected @endif>
                                    {{ $fornecedor->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>

                {{-- Linha 2 --}}
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <x-inputs.select name="inversor" label="Inversor">
                            <option value="0">Todos</option>
                            @foreach($inversores as $item)
                                <option value="{{ $item->id }}"
                                        @if ($item->id == $request->inversor) selected @endif>
                                    {{ $item->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-12 col-md-4">
                        <x-inputs.select name="painel" label="Painel">
                            <option value="0">Todos</option>
                            @foreach($paineis as $item)
                                <option value="{{ $item->id }}"
                                        @if ($item->id == $request->painel) selected @endif>
                                    {{ $item->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-6 col-md-2">
                        <x-inputs.select label="Status" name="status">
                            <option value="0" @if ('0' == $request->status) selected @endif>Todos</option>
                            <option value="1" @if ('1' == $request->status) selected @endif>Desativado</option>
                            <option value="2" @if ('2' == $request->status) selected @endif>Ativado</option>
                        </x-inputs.select>
                    </div>
                    <div class="col-6 col-md-2">
                        <x-inputs.select label="Status no Fornec." name="status_fornecedor">
                            <option value="0" @if ('0' == $request->status_fornecedor) selected @endif>Todos</option>
                            <option value="1" @if ('1' == $request->status_fornecedor) selected @endif>Desativado</option>
                            <option value="2" @if ('2' == $request->status_fornecedor) selected @endif>Ativado</option>
                        </x-inputs.select>
                    </div>
                </div>

                <div class="row mt-3 g-2">
                    <div class="col-12 col-md-auto filter-actions">
                        <button type="submit" class="btn btn-primary px-4">
                            Pesquisar
                        </button>
                    </div>
                    <div class="col-12 col-md-auto text-center">
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-3">
                            Limpar
                        </a>
                    </div>
                </div>

                {{-- contador fora do card em telas pequenas --}}
                <div class="row justify-content-end mt-1 d-lg-none">
                    <small class="text-muted">Mostrando {{ $kits->total() }} kits.</small>
                </div>
            </form>
        </div>

        <div class="p-3">
            @if ($kits->isEmpty())
                <div class="alert alert-info text-center mb-0">
                    Não foram encontrados kits.
                </div>
            @endif

            @foreach ($kits as $kit)
            @php
                // Mesmas imagens cadastradas em admin/produtos/inversores e
                // admin/produtos/paineis (Produtos::getDados()) — as mesmas usadas
                // na seção de imagens do kit nas propostas em PDF.
                $inversorImgs = $imgs[$kit->marca_inversor] ?? [];
                $painelImgs   = $imgs[$kit->marca_painel] ?? [];

                $fotoInversor = !empty($inversorImgs['produto']) ? asset('storage/'.$inversorImgs['produto']) : null;
                $logoInversor = !empty($inversorImgs['logo']) ? asset('storage/'.$inversorImgs['logo']) : null;

                $fotoPainel = !empty($painelImgs['produto']) ? asset('storage/'.$painelImgs['produto']) : null;
                $logoPainel = !empty($painelImgs['logo']) ? asset('storage/'.$painelImgs['logo']) : null;

                $categoriaLabel = $kit->categoria ? ucwords(mb_strtolower($kit->categoria)) : null;
            @endphp
            <div class="kit-card mb-4">
                <div class="kit-card-inner">
                    <div class="kit-content">
                        {{-- Cabeçalho --}}
                        <div class="kit-head">
                            <div>
                                <div class="badges">
                                    @if($categoriaLabel)
                                        <span class="badge-soft badge-categoria">
                                            <i class="fas fa-tag"></i> {{ $categoriaLabel }}
                                        </span>
                                    @endif
                                    {{-- status principal --}}
                                    @if($kit->status)
                                        <span class="badge-soft badge-status-on">
                                            <i class="fas fa-check-circle"></i> Ativo
                                        </span>
                                    @else
                                        <span class="badge-soft badge-status-off">
                                            <i class="fas fa-times-circle"></i> Inativo
                                        </span>
                                    @endif
                                    {{-- status fornecedor --}}
                                    @if($kit->status_fornecedor)
                                        <span class="badge-soft badge-status-on">
                                            <i class="fas fa-store-alt"></i> Fornecedor Ativo
                                        </span>
                                    @else
                                        <span class="badge-soft badge-status-off">
                                            <i class="fas fa-store"></i> Fornecedor Inativo
                                        </span>
                                    @endif
                                </div>
                                <h4 class="kit-title">{{ $kit->modelo }}</h4>
                                <div class="kit-subtitle">
                                    <i class="fas fa-barcode"></i> <span class="mono">{{ $kit->sku ?? 'sem código' }}</span>
                                    <span class="dot-sep">•</span>
                                    ID <span class="mono">#{{ $kit->id }}</span>
                                </div>
                            </div>
                            <a class="btn-kit-edit" href="{{ route('admin.produtos.kits.edit', $kit->id) }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>

                        <div class="divider"></div>

                        {{-- Destaques --}}
                        <div class="kit-stats">
                            <div class="stat-block stat-block--primary">
                                <span class="stat-label">Potência do Kit</span>
                                <span class="stat-value">{{ $kit->potencia_kit }} <small>kWp</small></span>
                            </div>
                            <div class="stat-block">
                                <span class="stat-label">Preço Cliente</span>
                                <span class="stat-value">R$ {{ convert_float_money(calculaPrecoPrincipalKit($kit->id)) }}</span>
                            </div>
                            <div class="stat-block">
                                <span class="stat-label">Margem de Venda</span>
                                <span class="stat-value">{{ getMargemPrincipal($kit->id) }} <small>%</small></span>
                            </div>
                        </div>

                        <div class="divider"></div>

                        {{-- Conteúdo em colunas --}}
                        <div class="row kit-columns">
                            {{-- Coluna 1 - Componentes --}}
                            <div class="col-12 col-lg-4">
                                <div class="info-group-title"><i class="fas fa-microchip"></i> Componentes</div>
                                <div class="info-row">
                                    <span class="label">Inversor</span>
                                    <span class="value">{{ $inversores[$kit->marca_inversor]->nome ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Potência Inversor</span>
                                    <span class="value">{{ $kit->potencia_inversor }} kW</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Painel</span>
                                    <span class="value">{{ $paineis[$kit->marca_painel]->nome ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Potência Painel</span>
                                    <span class="value">{{ $kit->potencia_painel }} Wp</span>
                                </div>
                            </div>

                            {{-- Coluna 2 - Especificações --}}
                            <div class="col-12 col-lg-4">
                                <div class="info-group-title"><i class="fas fa-ruler-combined"></i> Especificações</div>
                                <div class="info-row">
                                    <span class="label">Estrutura</span>
                                    <span class="value">{{ getEstrutura($kit->estrutura) }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Tensão</span>
                                    <span class="value">{{ $kit->tensao }} V</span>
                                </div>
                            </div>

                            {{-- Coluna 3 - Comercial --}}
                            <div class="col-12 col-lg-4">
                                <div class="info-group-title"><i class="fas fa-sack-dollar"></i> Comercial</div>
                                <div class="info-row">
                                    <span class="label">Preço Fornecedor</span>
                                    <span class="value">R$ {{ convert_float_money($kit->preco_fornecedor) }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Fornecedor</span>
                                    <span class="value">{{ $fornecedores[$kit->fornecedor]->nome ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        {{-- Rodapé --}}
                        <div class="kit-footer-meta">
                            <i class="far fa-clock"></i>
                            Cadastrado em {{ date('d/m/y', strtotime($kit->created_at)) }}
                            <span class="dot-sep">•</span>
                            Atualizado em {{ date('d/m/y H:i', strtotime($kit->updated_at)) }}
                        </div>
                    </div>

                    {{-- Bloco de imagens: foto + logo do inversor e do painel do kit --}}
                    <div class="kit-media">
                        <div class="component-card" title="Inversor: {{ $inversores[$kit->marca_inversor]->nome ?? '-' }}">
                            <div class="component-photo">
                                @if($fotoInversor)
                                    <img src="{{ $fotoInversor }}" alt="Foto do inversor" loading="lazy">
                                @else
                                    <i class="fas fa-bolt no-photo"></i>
                                @endif
                            </div>
                            <div class="component-logo">
                                @if($logoInversor)
                                    <img src="{{ $logoInversor }}" alt="Logo do inversor">
                                @endif
                            </div>
                            <span class="component-label">Inversor</span>
                        </div>
                        <div class="component-card" title="Painel: {{ $paineis[$kit->marca_painel]->nome ?? '-' }}">
                            <div class="component-photo">
                                @if($fotoPainel)
                                    <img src="{{ $fotoPainel }}" alt="Foto do painel" loading="lazy">
                                @else
                                    <i class="fas fa-th-large no-photo"></i>
                                @endif
                            </div>
                            <div class="component-logo">
                                @if($logoPainel)
                                    <img src="{{ $logoPainel }}" alt="Logo do painel">
                                @endif
                            </div>
                            <span class="component-label">Painel</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </x-body>

    {{-- Paginação --}}
    <div class="row justify-content-center my-4">
        <div class="col-auto">
            {{ $kits->onEachSide(1)->links() }}
        </div>
    </div>
</x-layout>
