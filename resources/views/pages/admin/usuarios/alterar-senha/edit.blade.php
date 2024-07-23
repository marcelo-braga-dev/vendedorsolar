<x-layout menu="perfil" submenu="senha">
    <x-body title="Resetar Senha" url-button="{{ route('admin.usuarios.vendedores.show', $usuario->id) }}">
        <form method="POST" action="{{route('admin.usuarios.alterar-senha.update', $usuario->id)}}"> @csrf @method('put')
            <label>
            <input type="checkbox" name="resetar" required>
            Resetar senha do usuário.</label>

            <div class="row justify-content-center py-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Resetar Senha</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
