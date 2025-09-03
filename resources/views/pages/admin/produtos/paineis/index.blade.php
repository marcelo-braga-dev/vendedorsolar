<x-layout menu="produtos" submenu="paineis">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }

            /* ===== Tabela ===== */
            .table thead th{
                font-weight:700; font-size:.9rem;
                color:#4a5568; background:#fafafa;
                border-bottom:2px solid #e9ecef;
            }
            .table tbody tr{ transition:background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }
            .table td, .table th{ vertical-align:middle; }

            /* ===== Imagens ===== */
            .brand-img{
                width:70px; height:70px; object-fit:contain;
                border-radius:10px; background:#fff;
                border:1px solid #edf2f7; padding:.25rem;
            }

            /* ===== Botão Editar ===== */
            .btn-edit{
                background:var(--brand); border-color:var(--brand);
                font-weight:600; color:#fff;
            }
            .btn-edit:hover{
                background:var(--brand-600); border-color:var(--brand-600);
            }
        </style>
    @endpush

    <x-body title="Painéis"
            class="p-0"
            text-button="Cadastrar Marca de Painel"
            url-button="{{ route('admin.produtos.paineis.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr class="text-center">
                    <th style="width: 90px">Produto</th>
                    <th>Marca</th>
                    <th style="width: 90px">Logo</th>
                    <th style="width: 80px"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($paineis as $item)
                    <tr class="text-center">
                        <td>
                            <img src="{{ asset('storage/'.$item->img_produto) }}"
                                 class="brand-img" alt="produto">
                        </td>
                        <td><strong>{{ $item->nome }}</strong></td>
                        <td>
                            <img src="{{ asset('storage/'.$item->img_logo) }}"
                                 class="brand-img" alt="logo">
                        </td>
                        <td>
                            <a class="btn btn-sm btn-edit"
                               href="{{ route('admin.produtos.paineis.edit', $item->id) }}"
                               title="Editar Painel">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-info-circle"></i> Nenhuma marca de painel cadastrada.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
