<x-layout menu="usuarios" submenu="vendedores">
    <x-body title="Editar Dados do Vendedor" url-button="{{ route('admin.usuarios.vendedores.index') }}">
        <form method="POST" action="{{route('admin.usuarios.vendedores.update', $usuario->id)}}"> @csrf @method('put')
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
            <div class="row border-top pt-2">
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right type="number" max="100" label="Comissão" name="taxa_comissao" value="{{ $comissao }}" step="0.01" box="%" required></x-inputs.input-box-right>
                </div>
                <div class="col-4">
                    <label class="form-control-label d-block pt-2">Permitir Acesso</label>
                    <label class="custom-toggle">
                        <input type="checkbox" name="status" @if ($usuario->status) checked @endif>
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
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
