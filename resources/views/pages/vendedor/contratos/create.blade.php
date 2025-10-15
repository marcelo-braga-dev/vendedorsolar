<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <form method="POST" enctype="multipart/form-data"
          action="{{ route('vendedor.contratos.store', ['id' => $orcamento->id]) }}"> @csrf
        <x-body title="Informações do Cliente do Financiamento"
                url-button="{{ route('vendedor.orcamento.show', $orcamento->id) }}">
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
        {{--        <x-body.card title="Informações Projeto">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input-box-left box="R$" label="Valor do Contrato" step="0.01" data-mask="000.000.000,00"--}}
        {{--                                             data-mask-reverse="true"--}}
        {{--                                             name="valor" value="{{ $orcamento->preco_cliente }}"--}}
        {{--                                             type="text" required></x-inputs.input-box-left>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input-box-right box="kWp" label="Potência do Sistema" step="0.001" type="number"--}}
        {{--                                              name="potencia" value="{{ $kit->potencia_kit * $orcamentoKit->qtd_kits  }}" required></x-inputs.input-box-right>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input-box-right box="kWh/mês" label="Consumo"--}}
        {{--                                              name="consumo" value="{{ $orcamentoInfo->consumo }}" type="number" required></x-inputs.input-box-right>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input-box-right box="kWh/mês" label="Geração Mensal"--}}
        {{--                                              name="geracao" value="{{ $orcamento->geracao }}" type="number" required></x-inputs.input-box-right>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </x-body.card>--}}
        {{--        <x-body.card title="Produtos">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input label="Marca dos Paineis" name="marca_paineis"--}}
        {{--                                    value="{{ $produtos[$kit->marca_painel]['nome'] }}" type="text" required></x-inputs.input>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-9">--}}
        {{--                    <x-inputs.input label="Garantia dos Paineis" name="garantia_paineis"--}}
        {{--                                    value="{{ $produtos[$kit->marca_painel]['garantia'] }}" type="text" required></x-inputs.input>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input label="Marca dos Inversores" name="marca_inversores"--}}
        {{--                                    value="{{ $produtos[$kit->marca_inversor]['nome'] }}" type="text" required></x-inputs.input>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-9">--}}
        {{--                    <x-inputs.input label="Garantia dos Inversores" name="garantia_inversores"--}}
        {{--                                    value="{{ $produtos[$kit->marca_inversor]['garantia'] }}" type="text" required></x-inputs.input>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input label="Qtd. Paineis" name="qtd_paineis"--}}
        {{--                                    value="" type="number" required></x-inputs.input>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input label="Qdt. Inversores" name="qtd_inversores"--}}
        {{--                                    value="" type="number" required></x-inputs.input>--}}
        {{--                </div>--}}
        {{--                <div class="col-md-3">--}}
        {{--                    <x-inputs.input-box-right box="kW" label="Potência do Inversor" name="potencia_inversor"--}}
        {{--                                    value="" type="number" required></x-inputs.input-box-right>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-12">--}}
        {{--                    <x-inputs.textarea name="produtos" label="Produtos"--}}
        {{--                                       rows="8">{{ $kit->produtos }}</x-inputs.textarea>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </x-body.card>--}}

        {{--        <x-body.card title="Outras Informações">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-12">--}}
        {{--                    <x-inputs.textarea name="formas_pagamento" label="Formas de Pagamento" required></x-inputs.textarea>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-12">--}}
        {{--                    <x-inputs.textarea name="clausulas" label="Cláusulas Adicionais" rows="4">10.6 -</x-inputs.textarea>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </x-body.card>--}}
        <x-body.card>
            <div class="form-row">
                <div class="col-auto mx-auto">
                    <button class="btn btn-primary" id="btn-submit">Gerar Contrato</button>
                </div>
            </div>
        </x-body.card>
    </form>
</x-layout>
