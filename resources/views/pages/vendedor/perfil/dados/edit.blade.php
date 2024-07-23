<x-layout menu="perfil" submenu="dados">
    <x-body title="Seus Dados">
        <form method="POST" action="{{route('vendedor.perfil.update', $usuario->id)}}"> @csrf @method('put')
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Nome" type="text" name="name" value="{{ $usuario->name }}"
                                    required></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Email" type="email" name="email" value="{{ $usuario->email }}"
                                    required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input label="CPF" type="text" name="cpf" id="cpf" class="mask-cpf"
                                    value="{{ $dados['cpf'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="CNPJ" type="text" name="cnpj" id="cnpj" class="mask-cnpj"
                                    value="{{ $dados['cnpj'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="RG" type="text" name="rg" id="rg" class="mask-rg"
                                    value="{{ $dados['rg'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input label="Celular" type="text" name="celular" id="celular" class="mask-celular"
                                    value="{{ $dados['celular'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Atualizar Dados</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
