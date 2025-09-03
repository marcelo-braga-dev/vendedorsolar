<x-layout menu="perfil" submenu="senha">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-050:#fff4ed; --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }

            .card-soft{
                border:1px solid #eef2f6; border-radius:16px;
                box-shadow:0 8px 26px rgba(0,0,0,.04); background:#fff;
                padding:1.5rem;
            }
            .form-label{ font-weight:600; }
            .input-group-text{
                background:#fff; border-right:0; color:#6c757d;
            }
            .form-control{ border-left:0; }
            .btn-primary{
                background:var(--brand); border-color:var(--brand);
                font-weight:700; letter-spacing:.3px;
            }
            .btn-primary:hover{ background:var(--brand-600); border-color:var(--brand-600); }
        </style>
    @endpush

    <x-layout.container title="Atualizar Senha">
        <div class="card-soft mx-auto">
            <form method="POST" action="{{ route('admin.senha.update', $usuario->id) }}">
                @csrf @method('put')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Senha atual</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="senha_atual" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nova Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password" name="nova_senha" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Repetir Nova Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="repetir_senha" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center pt-4">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-arrow-repeat"></i> Atualizar Senha
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-layout.container>
</x-layout>
