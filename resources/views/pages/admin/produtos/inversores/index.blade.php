<x-layout menu="produtos" submenu="inversores">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }

            /* tabela */
            .table thead th{
                font-weight:700; font-size:.9rem;
                color:#4a5568; background:#fafafa;
                border-bottom:2px solid #e9ecef;
            }
            .table tbody tr{ transition:background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }
            .table td, .table th{ vertical-align:middle; }

            /* imagens */
            .brand-img{
                width:60px; height:60px; object-fit:contain;
                border-radius:8px; background:#fff;
                border:1px solid #edf2f7; padding:.25rem;
            }

            /* botões */
            .btn-success{
                background:var(--brand); border-color:var(--brand);
                font-weight:600;
            }
            .btn-success:hover{
                background:var(--brand-600); border-color:var(--brand-600);
            }
        </style>
    @endpush

    <x-body title="Inversores"
            class="p-0"
            text-button="Cadastrar Marca de Inversor"
            url-button="{{ route('admin.produtos.inversores.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr class="text-center">
                    <th style="width: 80px">Produto</th>
                    <th>Marca</th>
                    <th style="width: 80px">Logo</th>
                    <th style="width: 80px"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($inversores as $item)
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
                            <a class="btn btn-sm btn-success"
                               href="{{ route('admin.produtos.inversores.edit', $item->id) }}"
                               title="Editar Inversor">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-info-circle"></i> Nenhuma marca de inversor cadastrada.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
