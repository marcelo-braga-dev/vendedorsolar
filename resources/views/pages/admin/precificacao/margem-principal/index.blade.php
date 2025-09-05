<x-layout menu="margens" submenu="margem-principal">
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

            /* ====== Cartões e títulos ====== */
            .card-soft {
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 8px 26px rgba(0, 0, 0, .04);
            }

            .section-title {
                font-weight: 800;
                letter-spacing: .2px;
            }

            /* ====== Form ====== */
            .form-panel {
                background: #fff;
                border: 1px solid #eef2f6;
                border-radius: 16px;
                padding: 1.25rem;
            }

            .hint {
                font-size: .875rem;
                color: #6c757d;
            }

            /* ====== Tabela ====== */
            .table thead th {
                border-bottom: 1px solid #eef2f6;
                font-weight: 700;
                color: #4a5568;
            }

            .table tbody tr {
                transition: background .12s ease;
            }

            .table tbody tr:hover {
                background: #fcfcfd;
            }

            .table td, .table th {
                vertical-align: middle;
            }

            /* Badge da margem */
            .badge-soft {
                border-radius: 999px;
                padding: .35rem .65rem;
                font-weight: 800;
                font-size: .75rem;
                border: 1px solid var(--brand-200);
                color: var(--brand-700);
                background: var(--brand-100);
            }

            /* Botões */
            .btn-ghost {
                display: inline-flex;
                align-items: center;
                gap: .45rem;
                border: 1px solid var(--brand);
                color: var(--brand);
                background: #fff;
                border-radius: 10px;
                padding: .45rem .8rem;
                font-weight: 800;
            }

            .btn-ghost:hover {
                color: #fff;
                background: var(--brand);
                border-color: var(--brand);
            }

            .btn-danger-soft {
                display: inline-flex;
                align-items: center;
                gap: .35rem;
                border: 1px solid rgba(220, 53, 69, .3);
                color: #dc3545;
                background: rgba(220, 53, 69, .06);
                border-radius: 10px;
                padding: .35rem .6rem;
                font-weight: 700;
            }

            .btn-danger-soft:disabled {
                opacity: .6;
                cursor: not-allowed;
            }

            /* Responsividade */
            @media (max-width: 991.98px) {
                .col-form {
                    margin-bottom: .75rem;
                }
            }
        </style>
    @endpush

    <x-body title="Margem Principal de Venda">
        {{-- Formulário --}}
        <div class="form-panel mb-3">
            <form method="POST" action="{{ route('admin.precificacao.margem-principal.store') }}"> @csrf
                <div class="col-12 col-lg-auto text-lg-start mb-4">
                    <h3 class="section-title mb-0">Cadastrar ou Atualizar Margem de Venda</h3>
                </div>
                <div class="row align-items-end g-3 justify-content-center">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-form">
                        <x-inputs.input-box-right label="Potência" type="number" box="kWp"
                                                  name="potencia" step="0.01" required></x-inputs.input-box-right>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-form">
                        <x-inputs.input-box-right label="Margem" type="number" box="%"
                                                  name="margem" step="0.01" required></x-inputs.input-box-right>
                    </div>

                    <div class="col-12 col-lg-auto text-center">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-body>

    {{-- Listagem --}}
    <x-body.card title="Margens Cadastradas" class="p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <x-tables.table-default>
                    <x-slot name="head">
                        <tr class="text-center">
                            <th>Potência Inicial</th>
                            <th></th>
                            <th>Potência Final</th>
                            <th>Margem</th>
                            <th class="text-end"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($margens as $index => $margem)
                            @php
                                $inicio = ($index - 1) >= 0 ? $margens[$index - 1]->potencia : 0;
                                $fim = $margem->potencia;
                            @endphp
                            <tr class="text-center">
                                <td><strong>{{ number_format($inicio, 2, ',', '.') }} kWp</strong></td>
                                <td>até</td>
                                <td><strong>{{ number_format($fim, 2, ',', '.') }} kWp</strong></td>
                                <td>
                                    <span class="badge-soft"><i class="bi bi-graph-up-arrow"></i> {{ number_format($margem->margem, 2, ',', '.') }}%</span>
                                </td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('admin.precificacao.margem-principal.destroy', $margem->id) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn-danger-soft"
                                                @if (count($margens) <= 1) disabled @endif
                                                onclick="return confirm('Remover esta faixa de margem?');">
                                            <i class="bi bi-trash3"></i> Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-info-circle"></i> Nenhuma margem cadastrada.
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-tables.table-default>
            </div>
        </div>
    </x-body.card>

    @push('js')
        <script>
            // (Opcional) Poderíamos validar rapidamente no cliente:
            // Impede valores negativos
            document.querySelectorAll('input[name="potencia"], input[name="margem"]').forEach(function (el) {
                el.addEventListener('input', function () {
                    if (this.value !== '' && parseFloat(this.value) < 0) this.value = 0;
                });
            });
        </script>
    @endpush
</x-layout>
