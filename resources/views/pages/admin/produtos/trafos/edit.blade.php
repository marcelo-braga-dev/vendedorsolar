<x-layout menu="produtos" submenu="trafos">
    <x-body title="Editar Informações do Transformador" url-button="{{ route('admin.produtos.trafos.index') }}">
        <form method="POST" action="{{ route('admin.produtos.trafos.update', $trafo->id) }}"> @csrf @method('PUT')
            <div class="row">
                <div class="col-12">
                    <x-inputs.input label="Modelo"
                                    value="{{ $trafo->modelo }}"
                                    type="text" name="modelo" id="modelo" required>
                    </x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input-box-right box="kW" label="Potência do Trafo" value="{{ $trafo->potencia }}"
                                              type="number" name="potencia" id="potencia" required>
                    </x-inputs.input-box-right>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input-box-left box="R$" class="mask-money" label="Preço do Fornecedor"
                                             value="{{ convert_float_money($trafo->preco_fornecedor)  }}"
                                             type="text" name="preco_fornecedor" id="preco_fornecedor" required>
                    </x-inputs.input-box-left>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right box="%" label="Margem de Venda" value="{{ $trafo->margem }}"
                                              type="number" name="margem" id="margem" step="0.01" required>
                    </x-inputs.input-box-right>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-left box="R$" label="Preço de Venda" value="{{ $trafo->preco_cliente }}"
                                             type="text" id="preco_cliente" name="preco_cliente" class="mask-money"
                                             readonly></x-inputs.input-box-left>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mx-auto p-3">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>

    @push('js')
        <script>
            $(function () {
                $('#margem, #preco_fornecedor').change(function () {
                    let precoFornecedor = $('#preco_fornecedor').val().replace('.', '').replace(',', '.');
                    let margem = $('#margem').val();

                    let precoCliente = precoFornecedor * (1 + margem / 100);
                    precoCliente = precoCliente.toFixed(2);

                    $('#preco_cliente').val(precoCliente)
                        .unmask()
                        .mask('000.000.000,00', {reverse: true});
                })
            });
        </script>
    @endpush
</x-layout>
