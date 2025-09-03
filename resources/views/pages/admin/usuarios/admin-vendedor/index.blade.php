<x-layout menu="usuarios" submenu="gerente-vendas">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            .table-wrap{ border:1px solid #eef2f6; border-radius:16px; overflow:hidden; box-shadow:0 8px 26px rgba(0,0,0,.04); }
            .table-modern{ margin-bottom:0; }
            .table-modern thead th{
                position:sticky; top:0; z-index:1;
                background:#fff; border-bottom:1px solid #eef2f6;
                color:#6b7280; font-weight:700; text-transform:uppercase; font-size:.78rem; letter-spacing:.02em;
            }
            .table-modern tbody tr:hover{ background:#fafbfc; }
            .table-modern td, .table-modern th{ vertical-align: middle; }
            .table-modern .col-actions{ width: 80px; text-align: right; }
            .badge-pill{
                border-radius:999px; padding:.35rem .65rem; font-weight:600; font-size:.78rem;
            }
            .badge-active{
                background: rgba(25,135,84,.1); color:#198754; border:1px solid rgba(25,135,84,.25);
            }
            .badge-inactive{
                background: rgba(220,53,69,.08); color:#dc3545; border:1px solid rgba(220,53,69,.25);
            }
            .btn-icon{
                --_size: 38px;
                width: var(--_size); height: var(--_size);
                display:inline-flex; align-items:center; justify-content:center;
                border-radius:10px; padding:0;
            }
            .btn-icon-primary{
                color: var(--brand); border-color: var(--brand); background:#fff;
            }
            .btn-icon-primary:hover{ color:#fff; background:var(--brand); border-color:var(--brand); }
        </style>
    @endpush

    <x-body title="Gerente de Vendas Cadastrados"
            text-button="Cadastrar Gerente de Vendas"
            url-button="{{ route('admin.usuarios.admins-vendedores.create') }}"
            class="p-0">

        <div class="table-wrap">
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
                                #{{ $usuario->id }}
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
                                <a  href="{{ route('admin.usuarios.admins-vendedores.show', $usuario->id) }}"
                                    class="btn btn-sm btn-outline-primary btn-icon btn-icon-primary"
                                    data-bs-toggle="tooltip" data-bs-title="Ver detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </x-body>

    @push('js')
        <script>
            // ativa tooltips
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el=>{
                new bootstrap.Tooltip(el);
            });
        </script>
    @endpush
</x-layout>
