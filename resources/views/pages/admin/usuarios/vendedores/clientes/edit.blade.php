<x-layout menu="usuarios" submenu="vendedores">
    <x-body title="Editar Informações do Cliente"
            url-button="{{ route('admin.usuarios.vendedor.clientes', $cliente->users_id) }}">
        <form method="POST"
              action="{{ route('admin.usuarios.vendedor.clientes.update', $cliente->id) }}"> @csrf @method('put')
            <h5>Pessoa Física</h5>
            <div class="form-row">
                <div class="col-md-6">
                    <x-inputs.input label="Nome" name="nome" type="text" value="{{ $cliente->nome }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="CPF" name="cpf" type="text" class="mask-cpf"
                                    value="{{ $dados['cpf'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="RG" name="rg" type="text" class="mask-rg" value="{{ $dados['rg'] ?? '' }}"/>
                </div>
            </div>
            <hr>

            <h5>Pessoa Jurídica</h5>
            <div class="form-row">
                <div class="col-md-4">
                    <x-inputs.input label="CNPJ" name="cnpj" id="cnpj" type="text" class="mask-cnpj"
                                    value="{{ $dados['cnpj'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-8">
                    <x-inputs.input label="Razão Social" name="razao_social" id="razao_social" type="text"
                                    value="{{ $cliente->razao_social }}"></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Inscrição Estadual" name="inscricao_social" id="inscricao_social"
                                    type="text" value="{{ $dados['inscricao_social'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-8">
                    <x-inputs.input label="Nome Fantasia" name="nome_fantasia" type="text" id="nome_fantasia"
                                    value="{{ $dados['nome_fantasia'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <hr>

            <h5>Contato</h5>
            <div class="form-row">
                <div class="col-md-4">
                    <x-inputs.input label="Celular" name="celular" type="text" class="mask-celular"
                                    value="{{ $dados['celular'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Telefone" name="telefone" type="text" class="mask-telefone"
                                    value="{{ $dados['telefone'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Email" name="email" type="email" value="{{ $dados['email'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <hr>

            <h5>Endereço</h5>
            <div class="form-row">
                <div class="col-6 col-md-2">
                    <x-inputs.input label="Cep" name="cep" id="cep" type="text"
                                    class="mask-cep" value="{{ $dados['cep'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-12 col-md-10">
                    <x-inputs.input label="Rua/Av" name="endereco" id="endereco" type="text"
                                    value="{{ $dados['endereco'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-4 col-md-2">
                    <x-inputs.input label="Número" name="numero" id="numero" type="text"
                                    value="{{ $dados['numero'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-8 col-md-4">
                    <x-inputs.input label="Complemento" name="complemento" type="text"
                                    value="{{ $dados['complemento'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-6">
                    <x-inputs.input label="Bairro" name="bairro" id="bairro" type="text"
                                    value="{{ $dados['bairro'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-6">
                    <x-inputs.select label="Estado" name="estado" id="estado" required>
                        <option value=""></option>
                        @foreach (getEstados() as $estado)
                            <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-6">
                    <x-inputs.select label="Cidade" name="cidade" id="cidade" required>
                    </x-inputs.select>
                </div>
            </div>
            <div class="form-row m-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
    @push('js')
        <script src="{{ asset('assets/js/select-cidades-estados.js') }}"></script>
        <script src="{{ asset('assets/js/pesquisa-cep.js') }}"></script>
        <script src="{{ asset('assets/js/pesquisa-cnpj.js') }}"></script>
        <script> selecionaLocalidade({{ $cliente->cidades_estados_id }}); </script>
    @endpush
</x-layout>
