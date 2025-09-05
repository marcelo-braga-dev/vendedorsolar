<x-layout menu="configs" submenu="concessionarias">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            /* Tabela */
            .table thead th{
                font-weight:700; font-size:.9rem; color:#4a5568;
                background:#fafafa; border-bottom:2px solid #e9ecef;
                white-space:nowrap;
            }
            .table td, .table th{ vertical-align: middle; }
            .table tbody tr{ transition: background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }

            /* Estado em chip */
            .chip-uf{
                display:inline-flex; align-items:center; gap:.4rem;
                border:1px solid #e7eaef; background:#fff; color:#495057;
                border-radius:999px; padding:.25rem .6rem; font-weight:800; font-size:.78rem;
            }
            .chip-uf .dot{ width:8px; height:8px; border-radius:999px; background:var(--brand); }

            /* Botão Editar (ghost brand) */
            .btn-ghost-brand{
                display:inline-flex; align-items:center; gap:.45rem;
                border:1px solid var(--brand); background:#fff; color:var(--brand);
                border-radius:10px; padding:.35rem .65rem; font-weight:800;
                white-space:nowrap;
            }
            .btn-ghost-brand:hover{ color:#fff; background:var(--brand); border-color:var(--brand); }

            .col-actions{ width:110px; }
            .mono{ font-variant-numeric: tabular-nums; }
            .truncate{ max-width:420px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
            @media (max-width: 991.98px){ .truncate{ max-width:260px; } }
            @media (max-width: 575.98px){ .truncate{ max-width:160px; } }
        </style>
    @endpush

    <x-body title="Concessionarias" class="p-0">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Estado</th>
                    <th class="text-start">Empresa</th>
                    <th>Tarifa Ponta</th>
                    <th>Tarifa Fora de Ponta</th>
                    <th class="text-end col-actions"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($items as $item)
                    <tr>
                        <td class="text-center">
                            <span class="chip-uf" title="Estado: {{ $item->estado }}">
                                <span class="dot"></span> {{ $item->estado }}
                            </span>
                        </td>

                        <td class="text-start">
                            <span class="truncate" title="{{ $item->nome }}">
                                {{ $item->nome }}
                            </span>
                        </td>

                        <td class="text-center mono">
                            R$ {{ convert_float_money($item->ponta, 5) }}
                        </td>

                        <td class="text-center mono">
                            R$ {{ convert_float_money($item->fora_ponta, 5) }}
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.configs.concessionarias.edit', $item->id )}}"
                               class="btn-ghost-brand" title="Editar">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> Nenhuma concessionária cadastrada.
                        </td>
                    </tr>
                @endforelse
            </x-slot>

            <x-slot name="paginate">
                {{ $items->onEachSide(1)->links() }}
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
