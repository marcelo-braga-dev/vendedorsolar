<x-layout menu="fornecedores" submenu="fornecedores_cadastrados">
    @push('css')
        <style>
            /* tabela */
            .table td, .table th{ vertical-align:middle; }
            .table tbody tr{ transition:background .15s ease; }
            .table tbody tr:hover{ background:#fff8f5; }

            /* colunas mais estreitas para ações */
            .col-actions{ width: 90px; }
            .truncate{ max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
            @media (max-width: 991.98px){ .truncate{ max-width:180px; } }
            @media (max-width: 575.98px){ .truncate{ max-width:120px; } }

            .fornecedor-nome{ font-weight:700; color:#212529; }
            .fornecedor-cnpj{ font-size:.76rem; color:#8891a0; }

            .badge-pill{
                border-radius:999px; padding:.32rem .6rem;
                font-weight:600; font-size:.76rem; white-space:nowrap;
            }
            .badge-kits{ background:#eef2f7; color:#495057; border:1px solid #e2e8f0; }

            .contact-icons{ display:flex; align-items:center; gap:.6rem; }
            .contact-icons a{ color:#8891a0; font-size:1rem; }
            .contact-icons a:hover{ color:var(--brand); }
            .contact-icons .disabled{ color:#dee2e6; pointer-events:none; }
        </style>
    @endpush

    <x-body title="Fornecedores Cadastrados"
            class="p-0"
            text-button="Cadastrar Fornecedor"
            url-button="{{ route('admin.fornecedores.create') }}">
        <div class="px-3 pt-3 pb-1">
            <form class="d-flex flex-wrap align-items-end gap-2">
                <div class="flex-grow-1" style="min-width:220px">
                    <x-inputs.input label="Buscar" name="busca" type="text" value="{{ $request->busca }}"
                                    placeholder="Empresa, representante ou e-mail"></x-inputs.input>
                </div>
                <button type="submit" class="btn btn-primary px-4">Pesquisar</button>
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Limpar</a>
                <small class="text-muted ms-auto">{{ $fornecedores->count() }} fornecedor(es)</small>
            </form>
        </div>

        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Empresa</th>
                    <th>Representante</th>
                    <th>Contato</th>
                    <th class="text-center">Kits</th>
                    <th class="text-end col-actions"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($fornecedores as $item)
                    @php
                        $email = trim($item->email ?? '');
                        $cel = trim($item->celular ?? '');
                        $tel = trim($item->telefone ?? '');
                        $site = trim($item->site ?? '');
                        $stat = $kitsPorFornecedor[$item->id] ?? null;
                    @endphp
                    <tr>
                        <td>
                            <div class="fornecedor-nome truncate" title="{{ $item->nome }}">{{ $item->nome }}</div>
                            @if($item->cnpj)
                                <div class="fornecedor-cnpj">{{ $item->cnpj }}</div>
                            @endif
                        </td>
                        <td class="truncate" title="{{ $item->representante }}">{{ $item->representante ?: '-' }}</td>

                        <td>
                            <div class="contact-icons">
                                <a href="{{ $email ? 'mailto:'.$email : '#' }}" class="{{ $email ? '' : 'disabled' }}"
                                   title="{{ $email ?: 'Sem e-mail' }}">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="{{ $cel ? 'tel:'.preg_replace('/\D/', '', $cel) : '#' }}" class="{{ $cel ? '' : 'disabled' }}"
                                   title="{{ $cel ?: 'Sem celular' }}">
                                    <i class="fas fa-mobile-alt"></i>
                                </a>
                                <a href="{{ $tel ? 'tel:'.preg_replace('/\D/', '', $tel) : '#' }}" class="{{ $tel ? '' : 'disabled' }}"
                                   title="{{ $tel ?: 'Sem telefone' }}">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a href="{{ $site ? (str_starts_with($site, 'http') ? $site : 'https://'.$site) : '#' }}"
                                   class="{{ $site ? '' : 'disabled' }}" target="_blank" rel="noopener"
                                   title="{{ $site ?: 'Sem site' }}">
                                    <i class="fas fa-globe"></i>
                                </a>
                            </div>
                        </td>

                        <td class="text-center">
                            <span class="badge badge-pill badge-kits">
                                {{ $stat->total ?? 0 }} · {{ $stat->ativos ?? 0 }} ativo(s)
                            </span>
                        </td>

                        <td class="text-end">
                            <a class="btn-ghost" href="{{ route('admin.fornecedores.show', $item->id) }}">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> Nenhum fornecedor encontrado.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
