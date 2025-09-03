<x-layout menu="margens" submenu="margem-fornecedor">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }

            /* ====== Estilos base ====== */
            .card-soft{ border:1px solid #eef2f6; border-radius:16px; box-shadow:0 8px 26px rgba(0,0,0,.04); }
            .section-title{ font-weight:800; letter-spacing:.2px; }

            /* ====== Form ====== */
            .form-panel{ background:#fff; border:1px solid #eef2f6; border-radius:16px; padding:1.25rem; }
            .hint{ font-size:.875rem; color:#6c757d; }
            .btn-primary{ font-weight:800; }

            /* ====== Tabela ====== */
            .table thead th{ border-bottom:1px solid #eef2f6; font-weight:700; color:#4a5568; }
            .table tbody tr{ transition: background .12s ease; }
            .table tbody tr:hover{ background:#fcfcfd; }
            .table td, .table th{ vertical-align: middle; }

            /* Badge de margem */
            .badge-soft{
                border-radius:999px; padding:.35rem .65rem; font-weight:800; font-size:.75rem;
                border:1px solid var(--brand-200); color:var(--brand-700); background:var(--brand-100);
            }

            /* Botões */
            .btn-danger-soft{
                display:inline-flex; align-items:center; gap:.35rem;
                border:1px solid rgba(220,53,69,.3); color:#dc3545; background:rgba(220,53,69,.06);
                border-radius:10px; padding:.35rem .6rem; font-weight:700;
            }
            .btn-danger-soft:hover{ background:rgba(220,53,69,.12); }
            .btn-danger-soft:disabled{ opacity:.6; cursor:not-allowed; }

            /* Responsividade */
            @media (max-width: 991.98px){
                .col-form{ margin-bottom:.75rem; }
            }
        </style>
    @endpush>

    <x-body title="Margem por Fornecedores">
        {{-- Formulário --}}
        <div class="form-panel mb-3">
            <form method="POST" action="{{ route('admin.precificacao.fornecedor.store') }}"> @csrf
                <div class="row align-items-end g-3">
                    <div class="col-12">
                        <h3 class="section-title mb-0">Cadastrar/Atualizar Margem por Fornecedor</h3>
                        <div class="hint mt-1">
                            Defina uma margem percentual que será aplicada aos kits vinculados a um fornecedor específico.
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-form">
                        <x-inputs.select label="Fornecedor" name="vendedor" required>
                            <option value=""></option>
                            @foreach($fornecedores as $index => $item)
                                <option value="{{ $index }}">{{ $item->nome }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>

                    <div class="col-12 col-md-3 col-form">
                        <x-inputs.input-box-right box="%" label="Margem" name="margem" type="number"
                                                  step="0.001" required></x-inputs.input-box-right>
                    </div>

                    <div class="col-12 col-md-3 text-md-start text-center">
                        <button class="btn btn-primary px-4">
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
                            <th>Fornecedor</th>
                            <th>Margem</th>
                            <th class="text-end"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($margens as $item)
                            <tr class="text-center">
                                <td>{{ $fornecedores[$item->meta_key]->nome ?? '-' }}</td>
                                <td>
                                    <span class="badge-soft">
                                        <i class="bi bi-graph-up-arrow"></i>
                                        {{ number_format((float) $item->value, 3, ',', '.') }} %
                                    </span>
                                </td>
                                <td class="text-end">
                                    <form method="POST"
                                          action="{{ route('admin.precificacao.vendedor.destroy', $item->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-danger-soft"
                                                onclick="return confirm('Remover a margem deste fornecedor?');">
                                            <i class="bi bi-trash3"></i> Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
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
            // (Opcional) impedir margem negativa
            document.querySelector('input[name="margem"]')?.addEventListener('input', function(){
                if (this.value !== '' && parseFloat(this.value) < 0) this.value = 0;
            });
        </script>
    @endpush
</x-layout>
