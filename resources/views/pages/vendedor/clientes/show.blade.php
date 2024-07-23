<x-layout menu="clientes" submenu="cadastrados">
    <x-body title="Dados do Cliente"
            url-button="back">
        <div class="row justify-content-end px-3 mb-3">
            <a href="{{ route('vendedor.clientes.edit', $cliente->id) }}"
               class="btn btn-success">Editar</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><b>Nome: </b>{{ $cliente->nome }}</p>
            </div>
            <div class="col-md-3">
                <p><b>CPF: </b>{{ $dados['cpf'] ?? '' }}</p>
            </div>
            <div class="col-md-3">
                <p><b>RG: </b>{{ $dados['rg'] ?? '' }}</p>
            </div>
        </div>
        <div class="row border-bottom mb-3">
            <div class="col-md-6">
                <p><b>Data de Nascimento: </b>{{ $dados['data_nascimento'] ?? '' }}</p>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col-md-6">
                <p><b>CNPJ: </b>{{ $dados['cnpj'] ?? '' }}</p>
            </div>
            <div class="col-md-6">
                <p><b>Razão Social: </b>{{ $cliente->razao_social }}</p>
            </div>
            <div class="col-md-6">
                <p><b>Nome Fantasia: </b>{{ $dados['nome_fantasia'] ?? '' }}</p>
            </div>
            <div class="col-md-6">
                <p><b>Inscriçao Social: </b>{{ $dados['inscricao_social'] ?? '' }}</p>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col-md-4">
                <p><b>Celular: </b>{{ $dados['celular'] ?? '' }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Telefone: </b>{{ $dados['telefone'] ?? '' }}</p>
            </div>
            <div class="col-md-4">
                <p><b>Email: </b>{{ $dados['email'] ?? '' }}</p>
            </div>
        </div>

        <div class="row border-bottom mb-3">
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
                <p><b>Cidade/Estado: </b>{{ getCidadeEstado($cliente->cidades_estados_id) }}</p>
            </div>
        </div>

        <div class="row border-bottom mb-3">
            <div class="col-12">
                <p><b>Anotações: </b>{{ $dados['anotacoes'] ?? '' }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p><b>Data Cadastro: </b>{{ date('d/m/y H:i', strtotime($cliente->created_at)) }}</p>
            </div>
        </div>
    </x-body>
</x-layout>


