<x-layout menu="produtos" submenu="trafos">
    @push('css')
        <style>
            /* ===== Card do transformador ===== */
            .trafo-card {
                border-radius: 16px;
                border: 1px solid #eef2f6;
                overflow: hidden;
                background: #fff;
                margin-bottom: 1rem;
            }

            .trafo-card:hover {
                box-shadow: 0 16px 40px rgba(0, 0, 0, .06);
                transform: translateY(-2px);
                transition: .18s ease;
            }

            .trafo-card-inner {
                display: flex;
                align-items: stretch;
            }

            .trafo-content {
                flex: 1;
                min-width: 0;
                padding: 1.5rem 1.75rem;
            }

            /* ---- Bloco de imagem: foto + logo da marca do transformador ---- */
            .trafo-media {
                flex: 0 0 210px;
                max-width: 210px;
                padding: 1.5rem 1.25rem;
                background: #fafbfc;
                border-left: 1px solid #eef2f6;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .trafo-component {
                width: 100%;
                background: #fff;
                border: 1px solid #eef2f6;
                border-radius: 14px;
                padding: 1rem .9rem .8rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: .65rem;
            }

            .trafo-photo {
                width: 100%;
                height: 130px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }

            .trafo-photo img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .trafo-photo .no-photo {
                color: #d5dae0;
                font-size: 2rem;
            }

            .trafo-logo {
                width: 100%;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: .55rem;
                border-top: 1px dashed #eef2f6;
            }

            .trafo-logo img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }

            .trafo-label {
                font-size: .66rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .4px;
                color: #8891a0;
            }

            @media (max-width: 767.98px) {
                .trafo-card-inner {
                    flex-direction: column;
                }

                .trafo-media {
                    flex: none;
                    max-width: none;
                    border-left: 0;
                    border-bottom: 1px solid #eef2f6;
                }

                .trafo-content {
                    padding: 1.25rem;
                }
            }

            /* ---- Cabeçalho ---- */
            .trafo-head {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .trafo-title {
                margin: .35rem 0 0;
                font-weight: 800;
                letter-spacing: .2px;
            }

            .trafo-subtitle {
                margin-top: .2rem;
                font-size: .82rem;
                color: #8891a0;
                display: flex;
                align-items: center;
                gap: .4rem;
            }

            .trafo-subtitle .mono {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            }

            .trafo-subtitle .dot-sep {
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

            .divider {
                border-top: 1px dashed #e9ecef;
                margin: 1.1rem 0;
            }

            /* ---- Destaques ---- */
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

            /* ---- Colunas de informação ---- */
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

            @media (max-width: 991.98px) {
                .trafo-columns > [class^="col-"] + [class^="col-"] {
                    margin-top: .75rem;
                }
            }

            .trafo-footer-meta {
                font-size: .78rem;
                color: #adb5bd;
                display: flex;
                align-items: center;
                gap: .4rem;
            }
        </style>
    @endpush

    <x-body title="Transformadores" class="p-0" text-button="Marcas de Transformadores"
            url-button="{{ route('admin.produtos.trafos-marcas.index') }}">

        <div class="p-3">
            @if($trafos->isEmpty())
                <div class="alert alert-info text-center mb-0">
                    <i class="fas fa-info-circle"></i> Nenhum transformador cadastrado.
                </div>
            @endif

            @foreach($trafos as $trafo)
                @php
                    $marca = $img[$trafo->produtos_id] ?? null;
                    $fotoMarca = !empty($marca?->img_produto) ? asset('storage/'.$marca->img_produto) : null;
                    $logoMarca = !empty($marca?->img_logo) ? asset('storage/'.$marca->img_logo) : null;
                @endphp
                <div class="trafo-card">
                    <div class="trafo-card-inner">
                        <div class="trafo-content">
                            {{-- Cabeçalho --}}
                            <div class="trafo-head">
                                <div>
                                    <div class="badges">
                                        @if($trafo->status)
                                            <span class="badge-soft badge-status-on">
                                                <i class="fas fa-check-circle"></i> Ativo
                                            </span>
                                        @else
                                            <span class="badge-soft badge-status-off">
                                                <i class="fas fa-times-circle"></i> Inativo
                                            </span>
                                        @endif
                                        @if($trafo->status_fornecedor)
                                            <span class="badge-soft badge-status-on">
                                                <i class="fas fa-store-alt"></i> Fornecedor Ativo
                                            </span>
                                        @else
                                            <span class="badge-soft badge-status-off">
                                                <i class="fas fa-store"></i> Fornecedor Inativo
                                            </span>
                                        @endif
                                    </div>
                                    <h4 class="trafo-title">{{ $trafo->modelo }}</h4>
                                    <div class="trafo-subtitle">
                                        <i class="fas fa-barcode"></i> <span class="mono">{{ $trafo->sku ?? 'sem código' }}</span>
                                        <span class="dot-sep">•</span>
                                        ID <span class="mono">#{{ $trafo->id }}</span>
                                    </div>
                                </div>
                                <a class="btn-kit-edit" href="{{ route('admin.produtos.trafos.edit', $trafo->id) }}"
                                   style="display:inline-flex;align-items:center;gap:.5rem;background:var(--brand);border:1px solid var(--brand);color:#fff;border-radius:10px;padding:.5rem 1rem;font-weight:700;white-space:nowrap;">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            </div>

                            <div class="divider"></div>

                            {{-- Destaques --}}
                            <div class="kit-stats">
                                <div class="stat-block stat-block--primary">
                                    <span class="stat-label">Potência</span>
                                    <span class="stat-value">{{ $trafo->potencia }} <small>kVA</small></span>
                                </div>
                                <div class="stat-block">
                                    <span class="stat-label">Preço Cliente</span>
                                    <span class="stat-value">R$ {{ convert_float_money($trafo->preco_cliente) }}</span>
                                </div>
                                <div class="stat-block">
                                    <span class="stat-label">Margem de Venda</span>
                                    <span class="stat-value">{{ $trafo->margem }} <small>%</small></span>
                                </div>
                            </div>

                            <div class="divider"></div>

                            {{-- Colunas --}}
                            <div class="row trafo-columns">
                                <div class="col-12 col-md-6">
                                    <div class="info-group-title"><i class="fas fa-sack-dollar"></i> Comercial</div>
                                    <div class="info-row">
                                        <span class="label">Preço Fornecedor</span>
                                        <span class="value">R$ {{ convert_float_money($trafo->preco_fornecedor) }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="label">Fornecedor</span>
                                        <span class="value">{{ $fornecedores[$trafo->fornecedor]->nome ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="info-group-title"><i class="fas fa-clipboard-list"></i> Observações</div>
                                    <div class="info-row" style="border-bottom:0;">
                                        <span class="value" style="text-align:left;font-weight:400;color:#6c757d;">
                                            {{ $trafo->observacoes ?: 'Sem observações.' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            {{-- Rodapé --}}
                            <div class="trafo-footer-meta">
                                <i class="far fa-clock"></i>
                                @if($trafo->created_at)
                                    Cadastrado em {{ date('d/m/y', strtotime($trafo->created_at)) }}
                                    <span class="dot-sep">•</span>
                                @endif
                                @if($trafo->updated_at)
                                    Atualizado em {{ date('d/m/y H:i', strtotime($trafo->updated_at)) }}
                                @else
                                    Sem data de atualização
                                @endif
                            </div>
                        </div>

                        {{-- Imagem da marca do transformador --}}
                        <div class="trafo-media">
                            <div class="trafo-component" title="{{ $marca->nome ?? '-' }}">
                                <div class="trafo-photo">
                                    @if($fotoMarca)
                                        <img src="{{ $fotoMarca }}" alt="Foto do transformador" loading="lazy">
                                    @else
                                        <i class="fas fa-bolt no-photo"></i>
                                    @endif
                                </div>
                                <div class="trafo-logo">
                                    @if($logoMarca)
                                        <img src="{{ $logoMarca }}" alt="Logo da marca">
                                    @endif
                                </div>
                                <span class="trafo-label">Transformador</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-body>
</x-layout>
