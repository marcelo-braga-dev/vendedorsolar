<x-layout menu="margens" submenu="margem-estado">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            /* Cabeçalho da seção (dentro do x-body) */
            .section-head{
                display:flex; align-items:center; justify-content:space-between;
                padding:.75rem 0; border-bottom:1px dashed #eef2f6;
            }
            .section-title{ margin:0; font-weight:800; letter-spacing:.2px; }
            .hint{ color:#6c757d; font-size:.9rem; }

            .divider{ border-top:1px dashed #e9ecef; margin:1rem 0; }

            /* grid dos inputs */
            .uf-grid{ row-gap:1rem; }
            .uf-col{ min-width: 180px; }

            /* botão principal */
            .btn-primary{ font-weight:800; }
            .sticky-actions{
                position: sticky; bottom: -1px; background: transparent;
                padding: 1rem 0; display:flex; justify-content:center;
                border-top:1px solid #f1f3f5;
            }
        </style>
    @endpush>

    @php
        // Regiões -> UFs (corrigido: último bloco é NORTE)
        $regioes = [
            'Sudeste'      => ['SP','RJ','ES','MG'],
            'Sul'          => ['PR','RS','SC'],
            'Centro-Oeste' => ['MT','MS','GO','DF'],
            'Nordeste'     => ['AL','BA','CE','MA','PI','RN','PE','PB','SE'],
            'Norte'        => ['AM','RR','AP','PA','RO','AC','TO'],
        ];
    @endphp

    {{-- REMOVIDO p-0 para aproveitar o padding natural do x-body --}}
    <x-body title="Margem por Estado">
        <form method="POST" action="{{ route('admin.precificacao.estado.store') }}"> @csrf
            <div class="section-head">
                <h5 class="section-title">Definição de Margem por UF</h5>
                <div class="hint">Informe o percentual de margem específico para cada estado (em %).</div>
            </div>

            @foreach($regioes as $regiao => $ufs)
                <div class="mt-3">
                    <h4 class="mb-2">{{ $regiao }}</h4>
                    <div class="row uf-grid">
                        @foreach($ufs as $uf)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 uf-col">
                                <x-inputs.input-box-right
                                    box="%"
                                    label="{{ $uf }}"
                                    type="number"
                                    name="{{ $uf }}"
                                    value="{{ $margens[$uf] ?? '' }}"
                                    step="0.001"></x-inputs.input-box-right>
                            </div>
                        @endforeach
                    </div>
                    @if (! $loop->last)
                        <div class="divider"></div>
                    @endif
                </div>
            @endforeach

            <div class="sticky-actions">
                <button class="btn btn-primary px-4">
                    <i class="bi bi-save2"></i> Salvar
                </button>
            </div>
        </form>
    </x-body>

    @push('js')
        <script>
            // Evita números negativos
            document.querySelectorAll('input[type="number"][name]').forEach(function(el){
                el.addEventListener('input', function(){
                    if (this.value !== '' && parseFloat(this.value) < 0) this.value = 0;
                });
            });
        </script>
    @endpush
</x-layout>
