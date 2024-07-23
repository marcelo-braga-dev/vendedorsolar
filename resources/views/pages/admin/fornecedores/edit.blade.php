<x-layout menu="fornecedores" submenu="">
    <x-body title="Editar Informações do Fornecedor" url-button="{{ route('admin.fornecedores.index') }}">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.fornecedores.update', $fornecedor->id) }}"> @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <x-inputs.input label="Nome da Empresa" name="nome"
                                    type="text" value="{{ $fornecedor->nome }}" required></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="CNPJ" name="cnpj" class="mask-cnpj" type="text"
                                    value="{{ $fornecedor->cnpj }}"></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Nome do Representante" name="representante" type="text"
                                    value="{{ $fornecedor->representante }}"></x-inputs.input>
                </div>
                <div class="col">
                    <x-inputs.input label="E-mail" name="email" type="email"
                                    value="{{ $fornecedor->email }}"></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.input class="mask-celular" label="Celular" name="celular" type="text"
                                    value="{{ $fornecedor->celular }}"></x-inputs.input>
                </div>
                <div class="col">
                    <x-inputs.input class="mask-telefone" label="Telefone" name="telefone" type="text"
                                    value="{{ $fornecedor->telefone }}"></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Site/Plataforma" name="site" type="text"
                                    value="{{ $fornecedor->site }}"></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Anotações" name="anotacoes"
                                       rows="4">{{ $fornecedor->anotacoes }}</x-inputs.textarea>
                </div>
            </div>

            <div class="row justify-content-center py-4">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
