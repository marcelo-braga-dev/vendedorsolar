<x-layout menu="financeiro" submenu="comissao-venda">
    <x-body title="Taxa de comissão do vendedor" url-button="{{ route('admin.financeiro.comissao-venda.index') }}">
        <form method="POST" action="{{route('admin.financeiro.comissao-venda.update', $id)}}"> @csrf @method('put')
            <div class="row">
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right type="number" max="100" label="Comissão" name="taxa_comissao"
                                              value="{{ $comissao->taxa ?? ''}}" step="0.01" box="%" required>
                    </x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-2 align-self-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
