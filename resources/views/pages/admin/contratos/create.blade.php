<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.contratos.store', ['id' => $orcamento->id]) }}"> @csrf
        <x-body title="Informações do Cliente do Financiamento"
                url-button="{{ route('admin.orcamentos.show', $orcamento->id) }}">
            <h5>ID do Orçamento: #{{ $orcamento->id }}</h5>
            <div class="form-row">
                <div class="col-md-8">
                    <x-inputs.input label="Nome ou Razão Social" type="text" name="nome"
                                    value="{{ getNomeCliente($orcamento->clientes_id) }}" required></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Documento (CPF ou CNPJ)" type="text" name="documento" value="{{($cliente->dados->cnpj ?? null)}}{{$cliente->dados->cpf}}"
                                    placeholder="CPF nº " required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <x-inputs.input label="Endereço" name="endereco" type="text" required value="{{$cliente->dados->endereco_completo ?? ''}} - {{getCidadeEstado($cliente->cidades_estados_id)}}"></x-inputs.input>
                </div>
            </div>
        </x-body>
        <x-body.card>
            <div class="form-row">
                <div class="col-auto mx-auto">
                    <button class="btn btn-primary" id="btn-submit">Gerar Contrato</button>
                </div>
            </div>
        </x-body.card>
    </form>
</x-layout>
