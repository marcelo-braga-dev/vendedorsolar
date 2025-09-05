<x-layout menu="margens" submenu="margem-vendedor">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }

            /* ====== Form ====== */
            .form-panel{ background:#fff; border:1px solid #eef2f6; border-radius:16px; padding:1.25rem; box-shadow:0 8px 26px rgba(0,0,0,.04); }
            .hint{ font-size:.9rem; color:#6c757d; }
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
        </style>
    @endpush

    <x-body title="Margem por Vendedor">
        {{-- Formulário --}}
        <div class="form-panel mb-3">
            <form method="POST" action="{{ route('admin.precificacao.vendedor.store') }}"> @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-12">
                        <div class="hint mb-1">Defina uma margem percentual aplicada às vendas deste vendedor.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <x-inputs.select label="Vendedor" name="vendedor" required>
                            <option value=""></option>
                            @foreach($vendedores as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>

                    <div class="col-12 col-md-3">
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
                            <th class="col-1">ID</th>
                            <th>Nome</th>
                            <th>Margem</th>
                            <th class="text-end"></th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($margens as $item)
                            <tr class="text-center">
                                <td><strong>#{{ $item->meta_key }}</strong></td>
                                <td>{{ nomeUsuario($item->meta_key) }}</td>
                                <td>
                                    <span class="badge-soft">
                                        <i class="bi bi-graph-up-arrow"></i>
                                        {{ number_format((float) $item->value, 3, ',', '.') }} %
                                    </span>
                                </td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('admin.precificacao.vendedor.destroy', $item->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-danger-soft"
                                                onclick="return confirm('Remover a margem deste vendedor?');">
                                            <i class="bi bi-trash3"></i> Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
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
            // Evita negativos no campo de margem
            document.querySelector('input[name="margem"]')?.addEventListener('input', function(){
                if (this.value !== '' && parseFloat(this.value) < 0) this.value = 0;
            });
        </script>
    @endpush
</x-layout>
