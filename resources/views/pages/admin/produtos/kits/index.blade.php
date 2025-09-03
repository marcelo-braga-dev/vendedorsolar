<x-layout menu="kits_fv" submenu="kits_fv_cadastrados">
    @push('css')
        <style>
            :root {
                --brand: #e25507;
                --brand-600: #cc4c06;
                --brand-700: #b44405;
                --brand-100: #ffe7da;
                --brand-200: #ffd6c2;
                --brand-300: #ffbe9f;
            }

            /* ====== Filtros ====== */
            .card-soft {
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 8px 26px rgba(0, 0, 0, .04);
            }

            .filter-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
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

            .kit-head {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .kit-title {
                margin: 0;
                font-weight: 800;
                letter-spacing: .2px;
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

            .brand-logo {
                width: 100%;
                max-width: 120px;
                aspect-ratio: 3/1;
                object-fit: contain;
                filter: saturate(1.05);
            }

            .divider {
                border-top: 1px dashed #e9ecef;
                margin: .9rem 0;
            }

            .meta {
                font-size: .95rem;
            }

            .meta .label {
                color: #6c757d;
                min-width: 130px;
                display: inline-block;
            }

            .meta .mono {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            }

            /* ações */
            .btn-ghost {
                display: inline-flex;
                align-items: center;
                gap: .45rem;
                border: 1px solid var(--brand);
                color: var(--brand);
                background: #fff;
                border-radius: 10px;
                padding: .45rem .8rem;
                font-weight: 700;
            }

            .btn-ghost:hover {
                color: #fff;
                background: var(--brand);
                border-color: var(--brand);
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

    <x-layout.container title="Kits Fotovoltaicos Cadastrados" class="p-0">
        <div class="mb-3 px-3">
            <form>
                <div class="card card-soft mb-2">
                    <div class="card-body">

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

                    </div>
                </div>

                {{-- contador fora do card em telas pequenas --}}
                <div class="row justify-content-end mb-1 d-lg-none">
                    <small class="text-muted">Mostrando {{ $kits->total() }} kits.</small>
                </div>
            </form>
        </div>
    </x-layout.container>

    @if ($kits->isEmpty())
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="alert alert-info text-center mb-4">
                    Não foram encontrados kits.
                </div>
            </div>
        </div>
    @endif

    <x-layout.container>
        @foreach ($kits as $kit)
            <div class="kit-card mb-3">
                <div class="p-3 p-md-4">
                    {{-- Cabeçalho --}}
                    <div class="kit-head">
                        <div>
                            <h4 class="kit-title">{{ $kit->modelo }}</h4>
                            <div class="badges mt-2">
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
                                {{-- sku --}}
                                <span class="badge-soft badge-sku">
                                    <i class="fas fa-barcode"></i> {{ $kit->sku ?? 'sem código' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 ms-auto">
                            <img src="{{ asset('storage/'.$imgs[$kit->marca_inversor]['logo']) }}" class="brand-logo" alt="logo inversor">
                            <img src="{{ asset('storage/'.$imgs[$kit->marca_painel]['logo']) }}" class="brand-logo" alt="logo painel">
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- Conteúdo em colunas --}}
                    <div class="row kit-columns">
                        {{-- Coluna 1 - Identificação/estados --}}
                        <div class="col-12 col-lg-4">
                            <div class="meta">
                                <div><span class="label">Potência do Kit:</span> <strong>{{ $kit->potencia_kit }} kWp</strong></div>
                                <div class="mt-1">
                                    <span class="label">ID:</span> <span class="mono">#{{ $kit->id }}</span>
                                </div>
                                <div class="mt-1">
                                    <span class="label">Código:</span> {{ $kit->sku ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Coluna 2 - Componentes --}}
                        <div class="col-12 col-lg-4">
                            <div class="meta">
                                <div><span class="label">Inversor:</span> {{ $inversores[$kit->marca_inversor]->nome }}</div>
                                <div><span class="label">Painel:</span> {{ $paineis[$kit->marca_painel]->nome }}</div>
                                <div><span class="label">Estrutura:</span> {{ getEstrutura($kit->estrutura) }}</div>
                                <div><span class="label">Tensão:</span> {{ $kit->tensao }} V</div>
                            </div>
                        </div>

                        {{-- Coluna 3 - Preços --}}
                        <div class="col-12 col-lg-4">
                            <div class="meta">
                                <div><span class="label">Preço Cliente:</span> R$ {{ convert_float_money(calculaPrecoPrincipalKit($kit->id)) }}</div>
                                <div><span class="label">Preço Fornecedor:</span> R$ {{ convert_float_money($kit->preco_fornecedor) }}</div>
                                <div><span class="label">Margem de Venda:</span> {{ getMargemPrincipal($kit->id) }} %</div>
                                <div><span class="label">Fornecedor:</span> {{ $fornecedores[$kit->fornecedor]->nome ?? '' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- Rodapé --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <small class="text-muted">Atualizado em: {{ date('d/m/y H:i', strtotime($kit->updated_at)) }}</small>

                        <div class="d-flex align-items-center gap-2">
                            <a class="btn-ghost" href="{{ route('admin.produtos.kits.edit', $kit->id) }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            {{-- exemplo: duplicar (se futuramente tiver rota)
                            <a class="btn btn-outline-secondary" href="#">
                                <i class="fas fa-clone"></i> Duplicar
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </x-layout.container>


    {{-- Paginação --}}
    <div class="row justify-content-center my-4">
        <div class="col-auto">
            {{ $kits->onEachSide(1)->links() }}
        </div>
    </div>
</x-layout>
