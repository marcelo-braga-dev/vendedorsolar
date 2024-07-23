<x-layout menu="margens" submenu="margem-principal">
    <x-body title="Margem Principal de Venda">
        <form method="POST" action="{{ route('admin.precificacao.margem-principal.store') }}"> @csrf
            <div class="row justify-content-center">
                <div class="col-auto">
                    <h3>Cadastrar ou Atualizar Margem de Venda</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-3">
                    <x-inputs.input-box-right label="Potência" type="number" box="kWp"
                                              name="potencia" step="0.01" required></x-inputs.input-box-right>
                </div>
                <div class="col-3">
                    <x-inputs.input-box-right label="Margem" type="number" box="%"
                                              name="margem" step="0.01" required></x-inputs.input-box-right>
                </div>
                <div class="col-auto align-self-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
    <x-body.card title="Margens Cadastradas" class="p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <x-tables.table-default>
                    <x-slot name="head">
                        <tr class="text-center">
                            <th>Potência Inicial</th>
                            <th></th>
                            <th>Potência Final</th>
                            <th>Margem</th>
                            <th></th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($margens as $index => $margem)
                            <tr class="text-center">
                                <th>
                                    @if ($index-1 >=0)
                                        {{ $margens[$index-1]->potencia }} kWp
                                    @else 0 kWp
                                    @endif
                                </th>
                                <td>a</td>
                                <th>
                                    {{ $margem->potencia }} kWp
                                </th>
                                <td>
                                    {{ $margem->margem }}%
                                </td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('admin.precificacao.margem-principal.destroy', $margem->id) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                @if (count($margens) <= 1) disabled @endif>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-tables.table-default>
            </div>
        </div>
    </x-body.card>
</x-layout>
