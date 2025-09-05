<x-layout menu="financeiro" submenu="bancos">
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
            .table td, .table th{ vertical-align:middle; }
            .table tbody tr{ transition:background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }

            /* Status */
            .status-ok{
                display:inline-flex; align-items:center; gap:.4rem;
                border:1px solid rgba(25,135,84,.25);
                background:rgba(25,135,84,.08); color:#198754;
                border-radius:999px; padding:.25rem .55rem; font-weight:800; font-size:.75rem;
            }
            .status-off{
                display:inline-flex; align-items:center; gap:.4rem;
                border:1px solid rgba(220,53,69,.25);
                background:rgba(220,53,69,.08); color:#dc3545;
                border-radius:999px; padding:.25rem .55rem; font-weight:800; font-size:.75rem;
            }

            /* Logo */
            .bank-logo{
                width:90px; height:42px; object-fit:contain;
                background:#fff; border:1px solid #edf2f7; border-radius:10px; padding:.25rem;
            }

            /* Ação */
            .btn-ghost-brand{
                display:inline-flex; align-items:center; gap:.45rem;
                border:1px solid var(--brand); background:#fff; color:var(--brand);
                border-radius:10px; padding:.35rem .65rem; font-weight:800;
                white-space:nowrap;
            }
            .btn-ghost-brand:hover{ color:#fff; background:var(--brand); border-color:var(--brand); }

            .col-actions{ width:110px; }
        </style>
    @endpush

    <x-body title="Bancos" class="p-0"
            text-button="Cadastrar Banco"
            url-button="{{ route('admin.configs.bancos.create') }}">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Status</th>
                    <th>Banco</th>
                    <th>Qtd. Parcelas</th>
                    <th>Juros Mensal</th>
                    <th>Carência</th>
                    <th>Logo</th>
                    <th class="text-end col-actions"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($bancos as $item)
                    <tr class="text-center">
                        <td>
                            @if ($item->status)
                                <span class="status-ok">
                                    <i class="bi bi-check-circle"></i> Ativo
                                </span>
                            @else
                                <span class="status-off">
                                    <i class="bi bi-x-circle"></i> Inativo
                                </span>
                            @endif
                        </td>

                        <td><strong>{{ $item->nome }}</strong></td>

                        <td class="text-center">{{ $item->qtd_parcelas }}x</td>

                        <td class="text-center">
                            {{ rtrim(rtrim(number_format((float)$item->juros_mensal, 3, ',', '.'), '0'), ',') }}%
                        </td>

                        <td class="text-center">
                            {{ (int) $item->carencia }} {{ (int)$item->carencia === 1 ? 'mês' : 'meses' }}
                        </td>

                        <td>
                            <img src="{{ asset('storage/'.$item->img_logo) }}" alt="logo {{ $item->nome }}" class="bank-logo">
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.configs.bancos.edit', $item->id )}}" class="btn-ghost-brand">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> Nenhum banco cadastrado.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
