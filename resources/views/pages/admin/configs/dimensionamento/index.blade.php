<x-layout menu="configs" submenu="dimensionamento">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            /* container interno do x-body */
            .section-head{
                display:flex; align-items:center; justify-content:space-between;
                padding:.5rem 0; border-bottom:1px dashed #eef2f6;
            }
            .section-title{ font-weight:800; letter-spacing:.2px; margin:0; }
            .hint{ color:#6c757d; font-size:.9rem; }

            .subhead{
                display:flex; align-items:center; gap:.5rem;
                margin:.75rem 0 .5rem 0; font-weight:800;
            }
            .subhead .dot{
                width:10px; height:10px; border-radius:999px; background:var(--brand);
            }
            .divider{ border-top:1px dashed #e9ecef; margin:1rem 0; }

            /* grid dos inputs */
            .field-col{ min-width: 220px; }

            /* botão principal */
            .btn-primary{ font-weight:800; }
            .sticky-actions{
                position: sticky; bottom: -1px; background: transparent;
                padding: 1rem 0; display:flex; justify-content:center;
                border-top:1px solid #f1f3f5;
            }
        </style>
    @endpush

    <x-body title="Dados para dimensionamento">
        <form method="POST" action="{{ route('admin.configs.dimensionamento.store') }}"> @csrf
            <div class="section-head mb-2">
                <h5 class="section-title">Parâmetros de Cálculo</h5>
                <div class="hint"><i class="bi bi-info-circle"></i> Ajuste fino dos coeficientes usados no dimensionamento.</div>
            </div>

            {{-- Cálculo --}}
            <div class="subhead">
                <span class="dot"></span> <span>Cálculo</span>
            </div>
            <div class="row g-3">
                <div class="col-12 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Ajuste da Equação"
                        name="margem_perda"
                        type="number"
                        value="{{ $dados['margem_perda'] }}"
                        step="0.01"></x-inputs.input-box-right>
                </div>
            </div>

            <div class="divider"></div>

            {{-- Performance Ratio (perdas do sistema) --}}
            <div class="subhead">
                <span class="dot"></span> <span>Performance Ratio (perdas do sistema)</span>
            </div>
            <div class="hint mb-2">
                PR composto atual: <strong>{{ $dados['performance_ratio'] }}%</strong>. Os fatores abaixo se
                compõem multiplicativamente (não somam) e substituem a antiga perda fixa de 15%.
            </div>
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-md-2 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Temperatura"
                        name="pr_temperatura"
                        type="number"
                        step="0.01"
                        value="{{ $dados['pr_temperatura'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-2 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Sujeira"
                        name="pr_sujeira"
                        type="number"
                        step="0.01"
                        value="{{ $dados['pr_sujeira'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-2 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Sombreamento"
                        name="pr_sombreamento"
                        type="number"
                        step="0.01"
                        value="{{ $dados['pr_sombreamento'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-2 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Cabeamento"
                        name="pr_cabeamento"
                        type="number"
                        step="0.01"
                        value="{{ $dados['pr_cabeamento'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-2 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Mismatch"
                        name="pr_mismatch"
                        type="number"
                        step="0.01"
                        value="{{ $dados['pr_mismatch'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-2 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Degradação inicial (LID)"
                        name="pr_degradacao_inicial"
                        type="number"
                        step="0.01"
                        value="{{ $dados['pr_degradacao_inicial'] }}"></x-inputs.input-box-right>
                </div>
            </div>

            <div class="divider"></div>

            {{-- Perda por orientação --}}
            <div class="subhead">
                <span class="dot"></span> <span>Perda por orientação</span>
            </div>
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Nordeste/Noroeste"
                        name="orientacao_nordeste_noroeste"
                        type="number"
                        step="0.01"
                        value="{{ $dados['orientacao_nordeste_noroeste'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Leste/Oeste"
                        name="orientacao_leste_oeste"
                        type="number"
                        step="0.01"
                        value="{{ $dados['orientacao_leste_oeste'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Sudeste/Sudoeste"
                        name="orientacao_sudeste_sudoeste"
                        type="number"
                        step="0.01"
                        value="{{ $dados['orientacao_sudeste_sudoeste'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Sul"
                        name="orientacao_sul"
                        type="number"
                        step="0.01"
                        value="{{ $dados['orientacao_sul'] }}"></x-inputs.input-box-right>
                </div>
            </div>

            <div class="divider"></div>

            {{-- Premissas financeiras (payback) --}}
            <div class="subhead">
                <span class="dot"></span> <span>Premissas Financeiras (Payback)</span>
            </div>
            <div class="hint mb-2">
                Usadas no gráfico de payback das propostas. Fio B conforme Lei 14.300/2022 — percentual abaixo é
                uma estimativa nacional simplificada da parcela TUSD-Fio B sobre a tarifa cheia (não decompõe por
                concessionária).
            </div>
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Degradação no 1º ano (LID)"
                        name="degradacao_ano1"
                        type="number"
                        step="0.01"
                        value="{{ $dados['degradacao_ano1'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Degradação anual (a partir do 2º ano)"
                        name="degradacao_anual"
                        type="number"
                        step="0.01"
                        value="{{ $dados['degradacao_anual'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Inflação energética (a.a.)"
                        name="inflacao_energetica"
                        type="number"
                        step="0.01"
                        value="{{ $dados['inflacao_energetica'] }}"></x-inputs.input-box-right>
                </div>

                <div class="col-12 col-sm-6 col-md-3 field-col">
                    <x-inputs.input-box-right
                        box="%"
                        label="Fio B (% estimado da tarifa)"
                        name="fio_b_percentual_tarifa"
                        type="number"
                        step="0.01"
                        value="{{ $dados['fio_b_percentual_tarifa'] }}"></x-inputs.input-box-right>
                </div>
            </div>

            <div class="sticky-actions">
                <button class="btn btn-primary px-4">
                    <i class="bi bi-save2"></i> Atualizar
                </button>
            </div>
        </form>
    </x-body>

    @push('js')
        <script>
            // proteção simples: evita negativos
            document.querySelectorAll('input[type="number"]').forEach(function(el){
                el.addEventListener('input', function(){
                    if (this.value !== '' && parseFloat(this.value) < 0) this.value = 0;
                });
            });
        </script>
    @endpush
</x-layout>
