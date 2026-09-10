<x-layout menu="usuarios" submenu="vendedores">
    @push('css')
        <style>
            .chip {
                display: inline-flex;
                align-items: center;
                gap: .35rem;
                height: 32px;
                padding: 0 .75rem;
                border: 1px solid #e7eaef;
                background: #fff;
                color: #495057;
                border-radius: 999px;
                font-weight: 600;
                font-size: .85rem;
                transition: all .2s ease;
            }

            .chip:hover {
                background: #f8f9fb;
                text-decoration: none;
            }

            .chip .dot {
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: #adb5bd;
            }

            .chip.active {
                border-color: var(--brand);
                color: var(--brand-700);
                background: var(--brand-100);
            }

            .chip.active .dot {
                background: var(--brand);
            }

            /* ---------- Tabela moderna ---------- */
            .table-modern {
                margin-bottom: 0;
            }

            .table-modern thead th {
                position: sticky;
                top: 0;
                z-index: 1;
                background: #fff;
                border-bottom: 1px solid #eef2f6;
                color: #6b7280;
                font-weight: 700;
                text-transform: uppercase;
                font-size: .78rem;
                letter-spacing: .02em;
            }

            .table-modern tbody tr:hover {
                background: #fafbfc;
            }

            .table-modern td, .table-modern th {
                vertical-align: middle;
            }

            .table-modern td .mono {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            }

            .table-modern .col-actions {
                width: 130px;
                text-align: right;
            }

            /* ---------- Identidade do vendedor ---------- */
            .vendedor-avatar {
                --_size: 42px;
                width: var(--_size);
                height: var(--_size);
                border-radius: 50%;
                background: var(--brand-100);
                color: var(--brand-700);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: .85rem;
                flex-shrink: 0;
            }

            .vendedor-id {
                flex-shrink: 0;
                width: 46px;
                font-size: .74rem;
                color: #adb5bd;
            }

            .vendedor-nome {
                font-weight: 700;
                color: #212529;
                line-height: 1.25;
            }

            .vendedor-email {
                font-size: .8rem;
                color: #8891a0;
            }

            .badge-active {
                background: rgba(25, 135, 84, .1);
                color: #198754;
                border: 1px solid rgba(25, 135, 84, .25);
            }

            .badge-inactive {
                background: rgba(220, 53, 69, .08);
                color: #dc3545;
                border: 1px solid rgba(220, 53, 69, .25);
            }

            .badge-comissao {
                background: var(--brand-100);
                color: var(--brand-700);
                border: 1px solid var(--brand-200);
            }

            .badge-clientes {
                background: #eef2f7;
                color: #495057;
                border: 1px solid #e2e8f0;
            }

            .text-muted-soft {
                color: #c3c9d1;
            }

            /* Botões de ação como ícones */
            .btn-icon {
                --_size: 38px;
                width: var(--_size);
                height: var(--_size);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 10px;
                padding: 0;
            }

            .btn-icon-primary {
                color: var(--brand);
                border-color: var(--brand);
                background: #fff;
            }

            .btn-icon-primary:hover {
                color: #fff;
                background: var(--brand);
                border-color: var(--brand);
            }

            .btn-icon-success {
                color: #198754;
                border-color: #198754;
                background: #fff;
            }

            .btn-icon-success:hover {
                color: #fff;
                background: #198754;
                border-color: #198754;
            }

            .btn-icon-warning {
                color: #fd7e14;
                border-color: #fd7e14;
                background: #fff;
            }

            .btn-icon-warning:hover {
                color: #fff;
                background: #fd7e14;
                border-color: #fd7e14;
            }

            /* Responsivo: empacotar em scroll horizontal */
            @media (max-width: 991.98px) {
                .table-responsive {
                    border-radius: 16px;
                }
            }
        </style>
    @endpush

    <x-body title="Vendedores Cadastrados"
            text-button="Cadastrar Vendedor"
            url-button="{{ route('admin.usuarios.vendedores.create') }}"
            class="p-0">
        <div class="px-3 pt-3 pb-1">
            <form>
                <div class="filter-head mb-3">
                    <h2 class="h6 mb-0">Filtros</h2>
                    <small class="text-muted">Mostrando {{ $usuarios->total() }} vendedor(es)</small>
                </div>

                <div class="mb-3 d-flex flex-wrap gap-2">
                    @php
                        $todos = $request->status === null || $request->status === '';
                        $ativos = $request->status === '1';
                        $inativos = $request->status === '0';
                    @endphp
                    <a href="?{{ http_build_query(array_merge($request->except('status', 'page'), [])) }}"
                       class="chip {{ $todos ? 'active' : '' }}"><span class="dot"></span> Todos</a>
                    <a href="?{{ http_build_query(array_merge($request->except('page'), ['status' => 1])) }}"
                       class="chip {{ $ativos ? 'active' : '' }}"><span class="dot"></span> Ativos</a>
                    <a href="?{{ http_build_query(array_merge($request->except('page'), ['status' => 0])) }}"
                       class="chip {{ $inativos ? 'active' : '' }}"><span class="dot"></span> Inativos</a>
                </div>

                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-4">
                        <x-inputs.input label="Nome" name="nome" type="text" value="{{ $request->nome }}"
                                        placeholder="Buscar por nome"></x-inputs.input>
                    </div>
                    <div class="col-12 col-md-4">
                        <x-inputs.input label="Email" name="email" type="text" value="{{ $request->email }}"
                                        placeholder="Buscar por email"></x-inputs.input>
                    </div>
                    <input type="hidden" name="status" value="{{ $request->status }}">
                    <div class="col-12 col-md-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Pesquisar</button>
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Limpar</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-modern align-middle">
                <thead>
                <tr>
                    <th class="text-center" style="width:46px"></th>
                    <th class="text-start">Vendedor</th>
                    <th>Celular</th>
                    <th class="text-center">Comissão</th>
                    <th class="text-center">Clientes</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Cadastro</th>
                    <th class="col-actions"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($usuarios as $usuario)
                    @php
                        $iniciais = collect(explode(' ', trim($usuario->name)))
                            ->filter()
                            ->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))
                            ->take(2)
                            ->implode('');
                        $comissao = $comissoes[$usuario->id] ?? null;
                        $totalClientes = $clientesCount[$usuario->id] ?? 0;
                    @endphp
                    <tr>
                        <td class="text-center">
                            <span class="vendedor-avatar">{{ $iniciais ?: '?' }}</span>
                        </td>

                        <td style="white-space: normal">
                            <div class="vendedor-nome">{{ $usuario->name }}</div>
                            <div class="vendedor-email">{{ $usuario->email }}</div>
                        </td>

                        <td>
                            @if(!empty($celulares[$usuario->id]))
                                {{ $celulares[$usuario->id] }}
                            @else
                                <span class="text-muted-soft">-</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($comissao !== null)
                                <span class="badge badge-pill badge-comissao">{{ $comissao }}%</span>
                            @else
                                <span class="text-muted-soft">-</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.usuarios.vendedor.clientes', $usuario->id) }}"
                               class="badge badge-pill badge-clientes text-decoration-none">
                                {{ $totalClientes }}
                            </a>
                        </td>

                        <td class="text-center">
                            @if ($usuario->status)
                                <span class="badge badge-pill badge-active">
                                    <i class="fas fa-check-circle me-1"></i> Ativo
                                </span>
                            @else
                                <span class="badge badge-pill badge-inactive">
                                    <i class="fas fa-times-circle me-1"></i> Inativo
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            {{ date('d/m/y', strtotime($usuario->created_at)) }}
                        </td>

                        <td class="col-actions">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.usuarios.vendedor.clientes', $usuario->id) }}"
                                   class="btn btn-sm btn-outline-warning btn-icon btn-icon-warning"
                                   data-bs-toggle="tooltip" data-bs-title="Clientes do vendedor">
                                    <i class="fas fa-users"></i>
                                </a>

                                <a href="{{ route('admin.usuarios.vendedores.show', $usuario->id) }}"
                                   class="btn btn-sm btn-outline-primary btn-icon btn-icon-primary"
                                   data-bs-toggle="tooltip" data-bs-title="Ver detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.usuarios.vendedores.edit', $usuario->id) }}"
                                   class="btn btn-sm btn-outline-success btn-icon btn-icon-success"
                                   data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-info-circle"></i> Nenhum vendedor encontrado.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </x-body>

    <div class="row justify-content-center my-4">
        <div class="col-auto">
            {{ $usuarios->onEachSide(1)->links() }}
        </div>
    </div>

    @push('js')
        <script>
            // Ativa tooltips dos botões de ação
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el);
            });
        </script>
    @endpush
</x-layout>
