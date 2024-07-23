<x-layout menu="usuarios" submenu="admins">
    <x-body title="Dados do Administrador" url-button="back">
        <div class="row justify-content-end px-3 mb-3">
            <a href="{{ route('admin.usuarios.admins.edit', $usuario->id) }}"
               class="btn btn-success">Editar</a>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p><b>Nome: </b>{{ $usuario->name }}</p>
            </div>
            <div class="col-md-3">
                <p><b>CPF: </b>{{ $dados['cpf'] ?? '' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>RG: </b>{{ $dados['rg'] ?? '' }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p><b>Email principal: </b>{{ $usuario->email }}</p>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><b>Celular: </b>{{ $dados['celular'] ?? '' }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Telefone: </b>{{ $dados['telefone'] ?? '' }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Email de contato: </b>{{ $dados['email'] ?? '' }}</p>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-12">
                <p><b>Endereco: </b>{{ $dados['endereco'] ?? '' }}</p>
            </div>
            <div class="col-md-2">
                <p><b>Numero: </b>{{ $dados['numero'] ?? '' }}</p>
            </div>
            <div class="col-md-2">
                <p><b>CEP: </b>{{ $dados['cep'] ?? '' }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Bairro: </b>{{ $dados['bairro'] ?? '' }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Cidade/Estado: </b></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <p><b>Data Cadastro: </b>{{ date('d/m/y H:i', strtotime($usuario->created_at)) }}</p>
            </div>
        </div>
    </x-body>
</x-layout>


