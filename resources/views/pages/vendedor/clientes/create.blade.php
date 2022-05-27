<x-layout menu="clientes" submenu="cadastrar">
    <x-body title="Cadastrar Cliente" url-button="">
        <form method="POST" action="{{ route('vendedor.clientes.store') }}"> @csrf
            <h5>Pessoa Física</h5>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.input label="Nome" name="nome" type="text" required/>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="CPF" name="cpf" type="text" class="mask-cpf"/>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="RG" name="rg" type="text" class="mask-rg"/>
                </div>
            </div>
            <hr>

            <h5>Pessoa Jurídica</h5>
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.input label="CNPJ" name="cnpj" id="cnpj" type="text" class="mask-cnpj"/>
                </div>
                <div class="col-md-8">
                    <x-inputs.input label="Razão Social" name="razao_social" id="razao_social" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.input label="Inscrição Estadual" name="inscricao_social" id="inscricao_social"
                                    type="text"/>
                </div>
                <div class="col-md-8">
                    <x-inputs.input label="Nome Fantasia" name="nome_fantasia" type="text" id="nome_fantasia"/>
                </div>
            </div>
            <hr>

            <h5>Contato</h5>
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.input label="Celular" name="celular" type="text" class="mask-celular"/>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Telefone" name="telefone" type="text" class="mask-telefone"/>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Email" name="email" type="email"/>
                </div>
            </div>
            <hr>

            <h5>Endereço</h5>
            <div class="row">
                <div class="col-3">
                    <x-inputs.input label="CEP" onblur="pesquisacep(this.value);" name="cep" id="cep" type="text"
                                    class="mask-cep"/>
                </div>
                <div class="col-6">
                    <x-inputs.input label="Rua/Av" name="endereco" id="endereco" type="text"/>
                </div>
                <div class="col-3">
                    <x-inputs.input label="Complemento" name="complemento" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <x-inputs.input label="Número" name="numero" id="numero" type="text"/>
                </div>
                <div class="col-4">
                    <x-inputs.input label="Bairro" name="bairro" id="bairro" type="text"/>
                </div>
                <div class="col-3">
                    <x-inputs.select label="Estado" name="estado" id="estado" required>
                        <option value=""></option>
                        @foreach (get_estados() as $estado)
                            <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-3">
                    <x-inputs.select label="Cidade" name="cidade" id="cidade" required>
                    </x-inputs.select>
                </div>
            </div>
            <div class="row m-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
                </div>
            </div>
        </form>
    </x-body>
    @push('js')
        <script>const urlBd = "{{route('cidades-estados')}}";</script>
        <script src="{{ asset('assets') }}/js/select-cidades-estados.js"></script>
        <script src="{{ asset('assets') }}/js/pesquisa-cep.js"></script>
        <script src="{{ asset('assets') }}/js/pesquisa-cnpj.js"></script>

    @endpush
</x-layout>
