<x-layout menu="usuarios" submenu="vendedores">
    @push('css')
        <style>
            :root {
                --brand: #e25507;
                --brand-600: #cc4c06;
                --brand-700: #b44405;
                --brand-100: #ffe7da;
                --brand-200: #ffd6c2;
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
                width: 120px;
                text-align: right;
            }

            .badge-pill {
                border-radius: 999px;
                padding: .35rem .65rem;
                font-weight: 600;
                font-size: .78rem;
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
        <div class="table-responsive">
            <table class="table table-hover table-modern align-middle">
                <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Status</th>
                    <th class="text-start">Nome</th>
                    <th class="text-start">Email</th>
                    <th>Data do Cadastro</th>
                    <th class="col-actions"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td class="text-center">
                            <span class="mono">#{{ $usuario->id }}</span>
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

                        <td style="white-space: normal">
                            {{ $usuario->name }}
                        </td>

                        <td>
                            {{ $usuario->email }}
                        </td>

                        <td class="text-center">
                            {{ date('d/m/y H:i', strtotime($usuario->created_at)) }}
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
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-body>

    @push('js')
        <script>
            // Ativa tooltips dos botões de ação
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el);
            });
        </script>
    @endpush
</x-layout>
