<x-layout menu="perfil" submenu="senha">
    <x-body title="Atualizar Senha">
        <form method="POST" action="{{route('vendedor.senha.update', $usuario->id)}}"> @csrf @method('put')
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.input label="Senha atual" type="password" name="senha_atual" required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.input label="Nova Senha" type="password" name="nova_senha" required></x-inputs.input>
                </div>
                <div class="col-md-6">
                    <x-inputs.input label="Repetir Nova Senha" type="password" name="repetir_senha" required></x-inputs.input>
                </div>
            </div>
            <div class="row justify-content-center py-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Atualizar Senha</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
