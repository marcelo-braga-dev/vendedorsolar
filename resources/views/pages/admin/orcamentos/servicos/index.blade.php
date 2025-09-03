<x-layout menu="orcamentos" submenu="servicos">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            /* Card / tabela */
            .card-soft{ border:1px solid #eef2f6; border-radius:16px; box-shadow:0 8px 26px rgba(0,0,0,.04); }
            .table thead th{ border-bottom:1px solid #eef2f6; font-weight:700; color:#4a5568; white-space:nowrap; }
            .table tbody tr{ transition: background .15s ease; }
            .table tbody tr:hover{ background:#fcfcfd; }
            .table td, .table th{ vertical-align: middle; }

            /* Valor em destaque */
            .price{ font-weight:800; letter-spacing:.2px; }

            /* Botão ação (opção B: Bootstrap Icons) */
            .btn-ghost{
                display:inline-flex; align-items:center; gap:.45rem;
                border:1px solid var(--brand); color:var(--brand); background:#fff;
                border-radius:10px; padding:.35rem .65rem; font-weight:800;
            }
            .btn-ghost:hover{ color:#fff; background:var(--brand); border-color:var(--brand); }

            /* Título truncado com tooltip */
            .title-cell{ max-width: 380px; }
            @media (max-width: 991.98px){ .title-cell{ max-width: 260px; } }
            @media (max-width: 575.98px){ .title-cell{ max-width: 160px; } }
        </style>
    @endpush>

    <x-body title="Propostas de Serviços" class="p-0">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th class="col-1">ID</th>
                    <th>Cliente</th>
                    <th>Consultor</th>
                    <th>Valor</th>
                    <th class="title-cell">Título</th>
                    <th class="text-end"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @foreach($propostas as $item)
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>

                        <td>
                            {{ ($item->cliente->nome ?? null) ?: ($item->cliente->razao_social ?? '-') }}
                        </td>

                        <td>
                            <strong>{{ $item->vendedor->name ?? '-' }}</strong>
                        </td>

                        <td class="price">
                            R$ {{ convert_float_money($item->valor) }}
                        </td>

                        <td class="title-cell">
                            @php $titulo = $item->titulo ?? '-'; @endphp
                            <span class="text-truncate d-inline-block w-100" data-bs-toggle="tooltip" title="{{ $titulo }}">
                                {{ $titulo }}
                            </span>
                        </td>

                        <td class="text-end">
                            <a class="btn-ghost" href="{{ route('admin.servicos.show', $item->id) }}">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>

    @push('js')
        <script>
            // Ativa tooltip do título (BS5)
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el=>{
                new (window.bootstrap?.Tooltip || function(){}) (el);
            });
        </script>
    @endpush>
</x-layout>
