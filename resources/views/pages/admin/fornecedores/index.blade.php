<x-layout menu="fornecedores" submenu="fornecedores_cadastrados">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            /* tabela */
            .table thead th{
                font-weight:700; font-size:.9rem; color:#4a5568;
                background:#fafafa; border-bottom:2px solid #e9ecef;
                white-space:nowrap;
            }
            .table td, .table th{ vertical-align:middle; }
            .table tbody tr{ transition:background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }

            /* botão ghost na brand */
            .btn-ghost{
                display:inline-flex; align-items:center; gap:.45rem;
                border:1px solid var(--brand); color:var(--brand); background:#fff;
                border-radius:10px; padding:.35rem .65rem; font-weight:800;
            }
            .btn-ghost:hover{ color:#fff; background:var(--brand); border-color:var(--brand); }

            /* colunas mais estreitas para ações */
            .col-actions{ width: 90px; }
            .truncate{ max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
            @media (max-width: 991.98px){ .truncate{ max-width:180px; } }
            @media (max-width: 575.98px){ .truncate{ max-width:120px; } }
        </style>
    @endpush

    <x-body title="Fornecedores Cadastrados"
            class="p-0"
            text-button="Cadastrar Fornecedor"
            url-button="{{ route('admin.fornecedores.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Empresa</th>
                    <th>Representante</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Telefone</th>
                    <th class="text-end col-actions"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($fornecedores as $item)
                    <tr>
                        <td><strong class="truncate" title="{{ $item->nome }}">{{ $item->nome }}</strong></td>
                        <td class="truncate" title="{{ $item->representante }}">{{ $item->representante }}</td>

                        {{-- E-mail clicável --}}
                        <td>
                            @php $email = trim($item->email ?? ''); @endphp
                            @if($email)
                                <a href="mailto:{{ $email }}" class="text-decoration-none">
                                    {{ $email }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- Celular / Telefone clicáveis --}}
                        <td>
                            @php $cel = trim($item->celular ?? ''); @endphp
                            @if($cel)
                                <a href="tel:{{ preg_replace('/\D/','',$cel) }}" class="text-decoration-none">
                                    {{ $cel }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @php $tel = trim($item->telefone ?? ''); @endphp
                            @if($tel)
                                <a href="tel:{{ preg_replace('/\D/','',$tel) }}" class="text-decoration-none">
                                    {{ $tel }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="text-end">
                            <a class="btn-ghost" href="{{ route('admin.fornecedores.show', $item->id) }}">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> Nenhum fornecedor cadastrado.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
