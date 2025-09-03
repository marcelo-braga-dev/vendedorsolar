<x-layout menu="financeiro" submenu="comissao-venda">
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
            }
            .table td, .table th{ vertical-align:middle; }
            .table tbody tr{ transition:background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }

            /* Comissão como badge */
            .badge-commission{
                display:inline-flex; align-items:center; gap:.35rem;
                border-radius:999px; padding:.35rem .6rem; font-weight:800; font-size:.78rem;
                color:var(--brand-700); background:var(--brand-100); border:1px solid var(--brand-200);
                white-space:nowrap;
            }

            /* Botão editar (ghost brand) */
            .btn-ghost-brand{
                display:inline-flex; align-items:center; gap:.45rem;
                border:1px solid var(--brand); background:#fff; color:var(--brand);
                border-radius:10px; padding:.35rem .65rem; font-weight:800;
            }
            .btn-ghost-brand:hover{ color:#fff; background:var(--brand); border-color:var(--brand); }

            /* Colunas */
            .col-actions{ width: 100px; }
            .mono{ font-variant-numeric: tabular-nums; }
        </style>
    @endpush>

    <x-body title="Taxa de Comissão por Venda" class="p-0">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th class="col-1">ID</th>
                    <th>Nome</th>
                    <th>Comissão</th>
                    <th>Data da Atualização</th>
                    <th class="text-end col-actions"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($usuarios as $usuario)
                    @php
                        $comissao = $comissoes[$usuario->id] ?? null;
                    @endphp
                    <tr>
                        <td><strong>#{{ $usuario->id }}</strong></td>

                        <td style="white-space: normal">
                            {{ $usuario->name }}
                        </td>

                        <td>
                            @if(!is_null($comissao) && $comissao !== '')
                                <span class="badge-commission">
                                    <i class="bi bi-percent"></i>
                                    {{ number_format((float)$comissao, 3, ',', '.') }}%
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td class="mono">
                            {{ date('d/m/y H:i', strtotime($usuario->created_at)) }}
                        </td>

                        <td class="text-end">
                            <a class="btn-ghost-brand"
                               href="{{ route('admin.financeiro.comissao-venda.edit', $usuario->id) }}"
                               title="Editar comissão">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> Nenhum usuário encontrado.
                        </td>
                    </tr>
                @endforelse
            </x-slot>

            <x-slot name="paginate">
                {{-- Paginação no padrão das outras telas --}}
                {{ $usuarios->onEachSide(1)->links() }}
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
