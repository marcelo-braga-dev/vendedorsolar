<x-layout menu="dimensionamento" submenu="convencional">
    @push('css')
        <style>
            :root {
                --brand: #e25507;
                --brand-600: #cc4c06;
                --ink: #111827;
                --muted: #6b7280;
                --line: #e5e7eb;
                --ok: #22c55e;
                --ok-700: #16a34a;
                --ok-50: #ecfdf5;
                --chip: #eef2ff;
                --chip-b: #c7d2fe;
                --chip-t: #3730a3;
                --shadow: 0 10px 30px rgba(17, 24, 39, .08);
            }

            /* ======= WRAPPER ======= */
            .kit-stack {
                gap: 1rem;
            }

            /* ======= CARTÃO PAI (marca/combinação) ======= */
            .kit-card {
                border: 1px solid var(--line);
                border-radius: 18px;
                background: #fff;
                box-shadow: var(--shadow);
                overflow: hidden;
            }

            .kit-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding: 1rem 1.25rem;
                background: linear-gradient(180deg, #fbfdff 0, #f7fafc 100%);
                border-bottom: 1px solid var(--line);
            }

            .kit-head .left {
                display: flex;
                align-items: center;
                gap: .75rem;
                flex-wrap: wrap;
                color: var(--muted);
            }

            .badge-total {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                padding: .4rem .7rem;
                border-radius: 999px;
                background: var(--chip);
                color: var(--chip-t);
                border: 1px solid var(--chip-b);
                font-weight: 800;
                font-size: .85rem;
                letter-spacing: .02em;
            }

            .brand-logos {
                display: flex;
                align-items: center;
                gap: .75rem;
            }

            .brand-logos img {
                height: 28px;
                width: auto;
                object-fit: contain;
                filter: saturate(1.05);
            }

            /* ======= LINHA DE KIT ======= */
            .kit-row {
                padding: 1rem 1.25rem;
                border-top: 1px dashed var(--line);
            }

            .kit-row:first-child {
                border-top: 0;
            }

            .kit-grid {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                align-items: flex-start;
                justify-content: space-between;
            }

            .kit-main {
                flex: 1 1 560px;
                min-width: 260px;
            }

            .kit-aside {
                flex: 0 0 260px;
                min-width: 240px;
                display: flex;
                flex-direction: column;
                gap: .5rem;
                align-items: flex-end;
            }

            /* texto */
            .kit-title {
                color: var(--ink);
                font-weight: 800;
                font-size: 1.05rem;
                line-height: 1.35;
                margin-bottom: .25rem;
            }

            .kit-sub {
                font-size: .85rem;
                color: var(--muted);
            }

            .kit-badges {
                margin: .25rem 0 .5rem;
                display: flex;
                gap: .5rem;
                flex-wrap: wrap;
            }

            .chip {
                padding: .28rem .6rem;
                border-radius: 999px;
                font-weight: 700;
                font-size: .75rem;
                border: 1px solid #fde68a;
                background: #fffbeb;
                color: #92400e;
            }

            /* metas em grid */
            .kit-meta {
                display: grid;
                grid-template-columns:repeat(2, minmax(180px, 1fr));
                gap: .4rem .9rem;
            }

            .kit-meta .item {
                font-size: .95rem;
                color: #1f2937;
            }

            .kit-meta small {
                display: block;
                text-transform: uppercase;
                letter-spacing: .04em;
                color: var(--muted);
                font-weight: 700;
            }

            /* preço + CTA */
            .price {
                font-weight: 900;
                font-size: 1.35rem;
                color: #0b132b;
            }

            .price small {
                color: var(--muted);
                font-weight: 700;
                margin-right: .25rem;
            }

            .btn-cta {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .5rem;
                width: 100%;
                max-width: 230px;
                padding: .68rem 1rem;
                background: linear-gradient(135deg, #22c55e, #16a34a 66%, #0ea5a3);
                color: #fff;
                border: none;
                border-radius: 12px;
                font-weight: 800;
                letter-spacing: .2px;
                box-shadow: 0 10px 24px rgba(34, 197, 94, .25);
                transition: transform .12s ease, filter .12s ease, box-shadow .12s ease;
                cursor: pointer;
            }

            .btn-cta:hover {
                color: #fff;
                transform: translateY(-1px);
                filter: brightness(1.04);
                box-shadow: 0 14px 30px rgba(34, 197, 94, .30);
            }

            .btn-cta:active {
                transform: translateY(0);
            }

            /* responsivo */
            @media (max-width: 768px) {
                .kit-aside {
                    align-items: flex-start;
                }

                .price {
                    font-size: 1.2rem;
                }
            }
        </style>
    @endpush
    @push('css')
        <style>
            :root {
                --brand: #e25507;
                --brand-600: #cc4c06;
                --brand-700: #b44405;
                --brand-050: #fff4ed;
                --brand-100: #ffe7da;
                --brand-200: #ffd6c2;
            }

            .card-soft {
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 8px 26px rgba(0, 0, 0, .04);
                background: #fff;
            }

            .section-title {
                font-weight: 800;
                font-size: 1.05rem;
            }

            .divider {
                border-top: 1px dashed #e9ecef;
                margin: 1rem 0;
            }

            .btn-brand {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                background: var(--brand);
                border-color: var(--brand);
                color: #fff;
                font-weight: 700;
                border-radius: 12px;
            }

            .btn-brand:hover {
                background: var(--brand-600);
                border-color: var(--brand-600);
                color: #fff;
            }

            .btn-outline-brand {
                border-color: var(--brand);
                color: var(--brand);
                font-weight: 700;
                border-radius: 12px;
            }

            .btn-outline-brand:hover {
                background: var(--brand);
                color: #fff;
            }

            .bi {
                line-height: 0;
                transform: translateY(-.5px);
            }

            /* Radio-as-switch */
            .radioswitch .form-check {
                padding: .35rem .75rem;
                border: 1px solid #e9ecef;
                border-radius: 12px;
                margin-right: .5rem;
                cursor: pointer;
            }

            .radioswitch .form-check-input {
                display: none;
            }

            .radioswitch .form-check-label {
                font-weight: 700;
                color: #6c757d;
            }

            .radioswitch .form-check-input:checked + .form-check-label {
                color: #fff;
            }

            .radioswitch .form-check:has(.form-check-input:checked) {
                background: var(--brand);
                border-color: var(--brand);
            }

            .hint {
                color: #6c757d;
                font-size: .85rem;
            }

            .badge-soft {
                border-radius: 999px;
                padding: .35rem .6rem;
                font-weight: 800;
                font-size: .78rem;
                color: var(--brand-700);
                background: var(--brand-100);
                border: 1px solid var(--brand-200);
            }
        </style>
    @endpush

    <x-layout.container title="Gerar Proposta - Sistema Convencional">
        <div class="card-soft p-3 p-md-4 mb-4">
            <form action="{{ route('vendedor.dimensionamento.convencional.create') }}" id="form-dimensionamento"> @csrf
                {{-- Linha: Cliente / Estado / Cidade --}}
                <div class="section-title mb-2"><i class="bi bi-person-check me-1"></i> Dados do Cliente</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    {{-- Cliente --}}
                    <div class="col-md-6">
                        <x-inputs.select label="Cliente" name="cliente" id="cliente">
                            <option value=""></option>
                            @foreach ($clientes as $item)
                                <option value="{{ $item->id }}" localidade="{{ $item->cidades_estados_id }}">
                                    {{ getNomeCliente($item->id) }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    {{-- Estado --}}
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Estado" name="estado" id="estado">
                            <option value=""></option>
                            @foreach (getEstados() as $estado)
                                <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    {{-- Cidade --}}
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Cidade" name="cidade" id="cidade"></x-inputs.select>
                    </div>
                </div>

                {{-- Linha: Estrutura / Tensão / Orientação --}}
                <div class="section-title mb-2"><i class="bi bi-gear me-1"></i> Parâmetros de Instalação</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Estrutura" name="estrutura" id="estrutura">
                            <option></option>
                            @foreach (getEstruturas() as $item)
                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Tensão" name="tensao" id="tensao">
                            <option></option>
                            <optgroup label="220V">
                                <option value="220">220V / Bifásico</option>
                                <option value="220">220V / Trifásico</option>
                            </optgroup>
                            <optgroup label="380V">
                                <option value="380">380V / Bifásico</option>
                                <option value="380">380V / Trifásico</option>
                            </optgroup>
                        </x-inputs.select>
                    </div>
                    <div class="col-12 col-md-3">
                        <x-inputs.select label="Direção da Instalação" name="orientacao" id="orientacao">
                            <option></option>
                            @foreach($orientacoes as $key => $orientacao)
                                <option value="{{ $key }}">{{ $orientacao }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>

                {{-- Linha: Consumo/Potência + Tipo --}}
                <div class="section-title mb-2"><i class="bi bi-lightning-charge me-1"></i> Dimensionamento</div>
                <div class="row g-3 align-items-end border-bottom pb-3 mb-3">
                    <div class="col-12 col-md-4">
                        <x-inputs.input-box-right class="input-consumo" label="Média Consumo Mensal" box="kWh/mês"
                                                  type="number" name="consumo" id="consumo" value=""></x-inputs.input-box-right>

                        <x-inputs.input-box-right class="input-potencia d-none" label="Potência do Sistema" box="kWp"
                                                  type="number" name="potencia" id="potencia" value=""></x-inputs.input-box-right>
                        {{--                        <div class="hint mt-1">Informe <span class="badge-soft">kWh/mês</span> ou troque para <span class="badge-soft">kWp</span>.</div>--}}
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="radioswitch d-flex">
                            <div class="form-check">
                                <input class="form-check-input check-tipo-consumo" type="radio" name="check-consumo" id="kwh" value="kwh" checked>
                                <label class="form-check-label" for="kwh"><i class="bi bi-speedometer2 me-1"></i>kWh/mês</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-tipo-consumo" type="radio" name="check-consumo" id="kwp" value="kwp">
                                <label class="form-check-label" for="kwp"><i class="bi bi-lightning me-1"></i>kWp</label>
                            </div>
                        </div>
                        <div class="hint mt-2">Informe o kWh/mês ou troque para kWp.</div>
                    </div>
                </div>

                {{-- Mais configurações --}}
                <div class="d-flex align-items-center gap-2 mb-2">
                    <button type="button" class="btn btn-outline-brand btn-sm" id="mais-config">
                        <i class="bi bi-sliders"></i> Mais configurações
                    </button>
                </div>

                <div class="row g-3 mais-config d-none">
                    <div class="col-auto align-self-center"><p class="mb-0">Qtd. de kits no sistema:</p></div>
                    <div class="col-auto col-md-2">
                        <x-inputs.input label="" type="number" name="qtd_kits" id="qtd_kits" value="1"></x-inputs.input>
                    </div>
                </div>

                <div class="row g-3 mais-config d-none border-bottom pb-3 mb-3">
                    <div class="col-auto align-self-center"><p class="mb-0">Verificar necessidade de trafo?</p></div>
                    <div class="col-auto">
                        <label class="custom-toggle ms-2">
                            <input type="checkbox" id="trafo" checked>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                        </label>
                    </div>
                </div>

                {{-- Alerta --}}
                <div class="row px-3" id="alert" style="display:none">
                    <div class="alert alert-danger col-12 text-center mb-0"><i class="bi bi-exclamation-octagon me-1"></i> Preencha todos os campos.</div>
                </div>

                {{-- Ações --}}
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6 text-center">
                        <button type="button" id="pesquisar-kits" class="btn btn-brand w-100">
                            <i class="bi bi-search"></i> Pesquisar Kits
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Refazer --}}
        <div class="row justify-content-center mb-4" id="refazer-wrapper" style="display:none">
            <div class="col-md-6 text-center">
                <button type="button" class="btn btn-outline-brand w-100" id="btn-refazer">
                    <i class="bi bi-arrow-counterclockwise"></i> Refazer Dimensionamento
                </button>
            </div>
        </div>

        <div class="row" id="kits"></div>

        @push('js')
            <script>
                $(function () {
                    // Alterna kWh <-> kWp
                    $('.check-tipo-consumo').on('change', function () {
                        const tipo = $('input[name="check-consumo"]:checked').val();

                        if (tipo === 'kwp') {
                            $('#consumo').prop('disabled', true).val('');
                            $('#potencia').prop('disabled', false);
                            $('.input-consumo').addClass('d-none');
                            $('.input-potencia').removeClass('d-none');
                        } else {
                            $('#consumo').prop('disabled', false);
                            $('#potencia').prop('disabled', true).val('');
                            $('.input-potencia').addClass('d-none');
                            $('.input-consumo').removeClass('d-none');
                        }
                    });

                    // Toggle bloco "Mais configurações"
                    $('#mais-config').on('click', function () {
                        $('.mais-config').toggleClass('d-none');
                    });

                    // Preenche Estado/Cidade ao escolher cliente
                    $('#cliente').on('change', function () {
                        const estadoCliente = $('#cliente option:selected').attr('localidade');
                        if (!estadoCliente) return;

                        $.get("{{ route('api.endereco.id.cidade.estado') }}", {id: estadoCliente}, function (result) {
                            if (!result) return;
                            preencheEstado(result.sigla);
                            preencheCidade(result.sigla, result.cidade);
                        });
                    });

                    // Buscar kits
                    $('#pesquisar-kits').on('click', function () {
                        const $btn = $(this);
                        const original = $btn.html();
                        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Pesquisando...');

                        $.get("{{ route('vendedor.dimensionamento.convencional.kits') }}", {
                            cidade: $('#cidade').val(),
                            estrutura: $('#estrutura').val(),
                            tensao: $('#tensao').val(),
                            orientacao: $('#orientacao').val(),
                            consumo: $('#consumo').val(),
                            cliente: $('#cliente').val(),
                            qtd_kits: $('#qtd_kits').val(),
                            tipo_consumo: $('input[name="check-consumo"]:checked').val(),
                            potencia: $('#potencia').val(),
                            verificar_trafo: $('#trafo').is(':checked')
                        }, function () {
                            $('#alert').hide();
                            $('#form-dimensionamento').toggle();
                            $('#kits').empty();
                        }).done(function (result) {
                            $('#kits').append(result);
                            $('#refazer-wrapper').show();
                        }).fail(function () {
                            $('#alert').show();
                            $('#kits').empty();
                        }).always(function () {
                            $btn.prop('disabled', false).html(original);
                        });
                    });

                    // Refazer
                    $('#btn-refazer').on('click', function () {
                        $('#refazer-wrapper').hide();
                        $('#form-dimensionamento').toggle();
                        $('#kits').empty();
                        // Reposiciona a tela para o formulário
                        window.scrollTo({top: document.querySelector('#form-dimensionamento').offsetTop - 80, behavior: 'smooth'});
                    });
                });
            </script>

            <script src="{{ asset('assets') }}/js/select-cidades-estados.js"></script>
        @endpush
    </x-layout.container>
</x-layout>
