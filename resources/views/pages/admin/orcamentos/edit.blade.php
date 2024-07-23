<x-layout menu="orcamentos">
    <x-body title="Orçamento" text-button="Voltar"
            url-button="{{ route('admin.orcamentos.show', $orcamento->id) }}">
        <form method="POST" action="{{ route('admin.orcamentos.update', $orcamento->id) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input-box-left label="Valor do Orçamento" type="text" box="R$"
                                             name="preco_cliente"
                                             value="{{ convert_float_money($orcamento->preco_cliente) }}"
                                             data-mask="000.000.000,00" data-mask-reverse="true" required>
                    </x-inputs.input-box-left>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Geração do Sistema" value="{{ $orcamento->geracao }}"
                                              type="number" box="kWh/mês" name="geracao" required>
                    </x-inputs.input-box-right>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-inputs.textarea label="Anotações/Observações"
                                       name="anotacoes">{{ $orcamento->anotacoes }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mx-auto">
                    <button type="submit" class="btn btn-primary">Atualizar Orçamento</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
