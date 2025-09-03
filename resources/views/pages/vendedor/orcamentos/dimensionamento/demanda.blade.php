<x-layout menu="dimensionamento" submenu="demanda">
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

            /* ======= CARTÕES DE KIT (compat com lista retornada) ======= */
            .kit-stack { gap: 1rem; }
            .kit-card {
                border: 1px solid var(--line);
                border-radius: 18px;
                background: #fff;
                box-shadow: var(--shadow);
                overflow: hidden;
            }
            .kit-head {
                display: flex; align-items: center; justify-content: space-between; gap: 1rem;
                padding: 1rem 1.25rem; background: linear-gradient(180deg, #fbfdff 0, #f7fafc 100%);
                border-bottom: 1px solid var(--line);
            }
            .kit-head .left { display: flex; align-items: center; gap: .75rem; flex-wrap: wrap; color: var(--muted); }
            .badge-total {
                display: inline-flex; align-items: center; gap: .5rem; padding: .4rem .7rem; border-radius: 999px;
                background: var(--chip); color: var(--chip-t); border: 1px solid var(--chip-b);
                font-weight: 800; font-size: .85rem; letter-spacing: .02em;
            }
            .kit-row { padding: 1rem 1.25rem; border-top: 1px dashed var(--line); }
            .kit-row:first-child { border-top: 0; }
            .kit-grid { display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; }
            .kit-main { flex: 1 1 560px; min-width: 260px; }
            .kit-aside { flex: 0 0 260px; min-width: 240px; display: flex; flex-direction: column; gap: .5rem; align-items: flex-end; }
            .kit-title { color: var(--ink); font-weight: 800; font-size: 1.05rem; line-height: 1.35; margin-bottom: .25rem; }
            .kit-sub { font-size: .85rem; color: var(--muted); }
            .kit-badges { margin: .25rem 0 .5rem; display: flex; gap: .5rem; flex-wrap: wrap; }
            .chip-yellow {
                padding: .28rem .6rem; border-radius: 999px; font-weight: 700; font-size: .75rem;
                border: 1px solid #fde68a; background: #fffbeb; color: #92400e;
            }
            .kit-meta { display: grid; grid-template-columns:repeat(2, minmax(180px, 1fr)); gap: .4rem .9rem; }
            .kit-meta .item { font-size: .95rem; color: #1f2937; }
            .kit-meta small { display: block; text-transform: uppercase; letter-spacing: .04em; color: var(--muted); font-weight: 700; }

            .price { font-weight: 900; font-size: 1.35rem; color: #0b132b; }
            .price small { color: var(--muted); font-weight: 700; margin-right: .25rem; }

            .btn-cta {
                display: inline-flex; align-items: center; justify-content: center; gap: .5rem; width: 100%; max-width: 230px;
                padding: .68rem 1rem; background: linear-gradient(135deg, #22c55e, #16a34a 66%, #0ea5a3);
                color: #fff; border: none; border-radius: 12px; font-weight: 800; letter-spacing: .2px;
                box-shadow: 0 10px 24px rgba(34, 197, 94, .25);
                transition: transform .12s ease, filter .12s ease, box-shadow .12s ease; cursor: pointer;
            }
            .btn-cta:hover { color:#fff; transform: translateY(-1px); filter: brightness(1.04); box-shadow: 0 14px 30px rgba(34,197,94,.30); }
            .btn-cta:active { transform: translateY(0); }

            @media (max-width: 768px) {
                .kit-aside { align-items: flex-start; }
                .price { font-size: 1.2rem; }
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
            .card-soft { border: 1px solid #eef2f6; border-radius: 16px; box-shadow: 0 8px 26px rgba(0,0,0,.04); background: #fff; }
            .section-title { font-weight: 800; font-size: 1.05rem; }
            .divider { border-top: 1px dashed #e9ecef; margin: 1rem 0; }

            .btn-brand {
                display:inline-flex; align-items:center; gap:.5rem; background: var(--brand); border-color: var(--brand);
                color:#fff; font-weight:700; border-radius:12px;
            }
            .btn-brand:hover { background: var(--brand-600); border-color: var(--brand-600); color:#fff; }
            .btn-outline-brand { border-color: var(--brand); color: var(--brand); font-weight:700; border-radius:12px; }
            .btn-outline-brand:hover { background: var(--brand); color:#fff; }

            .bi { line-height:0; transform: translateY(-.5px); }

            /* Chips + skeleton do cabeçalho de resultados */
            .chip { display:inline-flex; align-items:center; border:1px solid #e5e7eb; border-radius:999px; padding:.25rem .6rem; font-size:.8rem; margin:.2rem .25rem; background:#fff; }
            .chip .dot { width:.5rem; height:.5rem; border-radius:50%; margin-right:.4rem; background:#94a3b8; }
            .skeleton-card{ border:1px solid #e5e7eb; border-radius:.75rem; padding:1rem; margin-bottom:1rem }
            .skeleton{ position:relative; overflow:hidden; background:#f1f5f9; border-radius:.375rem; height:12px }
            .skeleton::after{ content:""; position:absolute; inset:0; transform:translateX(-100%); background:linear-gradient(90deg,transparent,rgba(255,255,255,.6),transparent); animation:skeleton 1.2s infinite }
            @keyframes skeleton{ 100%{ transform:translateX(100%) } }
            .skeleton.h-32{ height:8rem } .skeleton.h-20{ height:5rem }

            .is-invalid ~ .invalid-feedback{ display:block }
        </style>
    @endpush

    <x-layout.container title="Gerar Proposta - Sistema com Demanda">
        <div class="card-soft p-3 p-md-4 mb-4">
            <form action="{{ route('vendedor.dimensionamento.convencional.create') }}" id="form-dimensionamento"> @csrf
                {{-- Seção: Cliente / Estado / Cidade --}}
                <div class="section-title mb-2"><i class="bi bi-person-check me-1"></i> Dados do Cliente</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    <div class="col-md-6">
                        <x-inputs.select label="Cliente" name="cliente" id="cliente" required>
                            <option value="" selected disabled></option>
                            @foreach ($clientes as $item)
                                <option value="{{ $item->id }}" localidade="{{ $item->cidades_estados_id }}">
                                    {{ getNomeCliente($item->id) }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Estado" name="estado" id="estado" required>
                            <option value="" selected disabled></option>
                            @foreach (getEstados() as $estado)
                                <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Cidade" name="cidade" id="cidade" required>
                            <option value="" selected disabled></option>
                        </x-inputs.select>
                    </div>
                </div>

                {{-- Seção: Parâmetros de Instalação --}}
                <div class="section-title mb-2"><i class="bi bi-gear me-1"></i> Parâmetros de Instalação</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Estrutura" name="estrutura" id="estrutura" required>
                            <option value="" selected disabled></option>
                            @foreach (getEstruturas() as $item)
                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-6 col-md-3">
                        <x-inputs.select label="Tensão" name="tensao" id="tensao" required>
                            <option value="" selected disabled></option>
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
                        <x-inputs.select label="Direção da Instalação" name="orientacao" id="orientacao" required>
                            <option value="" selected disabled></option>
                            @foreach($orientacoes as $key => $orientacao)
                                <option value="{{ $key }}">{{ $orientacao }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-12 col-md-3">
                        <x-inputs.select label="Concessionária" name="concessionaria" id="concessionaria" required>
                            <option value="" selected disabled></option>
                            @foreach ($concessionarias as $item)
                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>

                {{-- Seção: Perfil de consumo e demanda --}}
                <div class="section-title mb-2"><i class="bi bi-lightning-charge me-1"></i> Perfil de Consumo & Demanda</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    <div class="col-md-4">
                        <x-inputs.input-box-right label="Consumo Fora de Ponta" box="kWh"
                                                  type="number" name="consumo_fora_ponta" id="consumo_fora_ponta"
                                                  value="" step="0.01" min="0" required />
                    </div>
                    <div class="col-md-4">
                        <x-inputs.input-box-right label="Consumo na Ponta" box="kWh"
                                                  type="number" name="consumo_ponta" id="consumo_ponta"
                                                  value="" step="0.01" min="0" required />
                    </div>
                    <div class="col-md-4">
                        <x-inputs.input-box-right label="Demanda Contratada" box="kW"
                                                  type="number" name="demanda" id="demanda"
                                                  value="" step="0.01" min="0" required />
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
                        <x-inputs.input type="number" name="qtd_kits" label="" id="qtd_kits" value="1" min="1"></x-inputs.input>
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
                    <div class="alert alert-danger col-12 text-center mb-0">
                        <i class="bi bi-exclamation-octagon me-1"></i> Preencha todos os campos obrigatórios.
                    </div>
                </div>

                {{-- Ações --}}
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6 text-center">
                        <button type="button" id="pesquisar-kits" class="btn btn-brand w-100">
                            <i class="bi bi-search"></i> <span class="label">Pesquisar Kits</span>
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

        {{-- Chips-resumo --}}
        <div class="row mb-2 d-none" id="chips-resumo">
            <div class="col-12">
                <div class="chip"><span class="dot"></span> Cliente: <span class="ms-1" id="chip-cliente">—</span></div>
                <div class="chip"><span class="dot"></span> Local: <span class="ms-1" id="chip-local">—</span></div>
                <div class="chip"><span class="dot"></span> Tensão: <span class="ms-1" id="chip-tensao">—</span></div>
                <div class="chip"><span class="dot"></span> Estrutura: <span class="ms-1" id="chip-estrutura">—</span></div>
                <div class="chip"><span class="dot"></span> Concessionária: <span class="ms-1" id="chip-conc">—</span></div>
            </div>
        </div>

        {{-- Skeletons (loading) --}}
        <div class="row d-none" id="skeletons">
            <div class="col-md-4">
                <div class="skeleton-card">
                    <div class="skeleton h-32 mb-3"></div>
                    <div class="skeleton mb-2"></div>
                    <div class="skeleton mb-2"></div>
                    <div class="skeleton w-50"></div>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <div class="skeleton-card">
                    <div class="skeleton h-32 mb-3"></div>
                    <div class="skeleton mb-2"></div>
                    <div class="skeleton mb-2"></div>
                    <div class="skeleton w-50"></div>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <div class="skeleton-card">
                    <div class="skeleton h-32 mb-3"></div>
                    <div class="skeleton mb-2"></div>
                    <div class="skeleton mb-2"></div>
                    <div class="skeleton w-50"></div>
                </div>
            </div>
        </div>

        {{-- Resultados --}}
        <div class="row" id="kits"></div>

        @push('js')
            <script>
                $(function () {
                    // Toggle "Mais configurações"
                    $('#mais-config').on('click', function () {
                        $('.mais-config').toggleClass('d-none');
                    });

                    // Cliente → Estado/Cidade
                    $('#cliente').on('change', function () {
                        const estadoCliente = $('#cliente option:selected').attr('localidade');
                        if (!estadoCliente) return;

                        $.get("{{ route('api.endereco.id.cidade.estado') }}", { id: estadoCliente }, function (result) {
                            if (!result) return;
                            preencheEstado(result.sigla);
                            preencheCidade(result.sigla, result.cidade);
                        });
                    });

                    // Helpers validação
                    function markInvalid($el){ $el.addClass('is-invalid'); if(!$el.next('.invalid-feedback').length){ $el.after('<div class="invalid-feedback">Campo obrigatório.</div>'); } }
                    function clearInvalid($el){ $el.removeClass('is-invalid'); $el.next('.invalid-feedback').remove(); }
                    function validateForm(){
                        const ids = ['#cliente','#estado','#cidade','#estrutura','#tensao','#orientacao','#concessionaria','#consumo_fora_ponta','#consumo_ponta','#demanda'];
                        let ok = true, first = null;
                        ids.forEach(sel=>{
                            const $el = $(sel); clearInvalid($el);
                            const v = ($el.val()||'').toString().trim();
                            if(!v){ ok=false; if(!first) first=$el; markInvalid($el); }
                            else if($el.is('[type="number"]')){
                                const n = parseFloat(v); if(isNaN(n)||n<0){ ok=false; if(!first) first=$el; markInvalid($el); }
                            }
                        });
                        if(!ok && first){
                            $('#alert').show();
                            $('html, body').animate({ top: 0 }, 150);
                            first.focus();
                        }else{
                            $('#alert').hide();
                        }
                        return ok;
                    }

                    // Chips resumo
                    function fillChips(){
                        const clienteTxt = $('#cliente option:selected').text() || '—';
                        const estadoTxt = $('#estado option:selected').text() || '';
                        const cidadeTxt = $('#cidade option:selected').text() || '';
                        const tensaoTxt = $('#tensao option:selected').text() || '—';
                        const estruturaTxt = $('#estrutura option:selected').text() || '—';
                        const concTxt = $('#concessionaria option:selected').text() || '—';

                        $('#chip-cliente').text(clienteTxt.trim());
                        $('#chip-local').text((cidadeTxt && estadoTxt) ? (cidadeTxt.trim() + ' - ' + estadoTxt.trim()) : '—');
                        $('#chip-tensao').text(tensaoTxt.trim());
                        $('#chip-estrutura').text(estruturaTxt.trim());
                        $('#chip-conc').text(concTxt.trim());
                        $('#chips-resumo').removeClass('d-none');
                    }

                    // Buscar kits (Demanda)
                    $('#pesquisar-kits').on('click', function () {
                        if(!validateForm()) return;

                        const $btn = $(this);
                        const original = $btn.html();
                        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Pesquisando...');
                        $('#skeletons').removeClass('d-none');
                        $('#kits').empty();
                        $('#refazer-wrapper').hide();

                        $.get("{{ route('vendedor.dimensionamento.demanda.kits') }}", {
                            cidade: $('#cidade').val(),
                            estrutura: $('#estrutura').val(),
                            tensao: $('#tensao').val(),
                            orientacao: $('#orientacao').val(),
                            consumo_fora_ponta: $('#consumo_fora_ponta').val(),
                            consumo_ponta: $('#consumo_ponta').val(),
                            demanda: $('#demanda').val(),
                            cliente: $('#cliente').val(),
                            concessionaria: $('#concessionaria').val(),
                            qtd_kits: $('#qtd_kits').val(),
                            verificar_trafo: $('#trafo').is(':checked')
                        }, function () {
                            $('#alert').hide();
                            $('#form-dimensionamento').toggle();
                        }).done(function (result) {
                            fillChips();
                            $('#kits').html(result);
                            $('#refazer-wrapper').show();
                            window.scrollTo({ top: document.querySelector('#chips-resumo').offsetTop - 80, behavior: 'smooth' });
                        }).fail(function () {
                            $('#alert').show();
                            $('#kits').empty();
                        }).always(function () {
                            $btn.prop('disabled', false).html(original);
                            $('#skeletons').addClass('d-none');
                        });
                    });

                    // Refazer
                    $('#btn-refazer').on('click', function () {
                        $('#refazer-wrapper').hide();
                        $('#form-dimensionamento').toggle();
                        $('#kits').empty();
                        window.scrollTo({ top: document.querySelector('#form-dimensionamento').offsetTop - 80, behavior: 'smooth' });
                    });

                    // Limpa inválido ao digitar/alterar
                    $(document).on('change keyup', 'select, input', function(){ clearInvalid($(this)); });
                });
            </script>

            <script src="{{ asset('assets') }}/js/select-cidades-estados.js"></script>
        @endpush
    </x-layout.container>
</x-layout>
