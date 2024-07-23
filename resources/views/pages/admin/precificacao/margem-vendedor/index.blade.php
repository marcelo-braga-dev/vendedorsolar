<x-layout menu="margens" submenu="margem-vendedor">
    <x-body title="Margem por Vendedor">
        <form method="POST" action="{{ route('admin.precificacao.vendedor.store') }}"> @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <x-inputs.select label="Vendedor" name="vendedor" required>
                        <option value=""></option>
                        @foreach($vendedores as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right box="%" label="Margem" name="margem" type="number"
                                              step="0.001" required></x-inputs.input-box-right>
                </div>
                <div class="col-md-3 align-self-center">
                    <button class="btn btn-primary">Salvar</button>
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
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Margem</th>
                            <th></th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($margens as $item)
                            <tr class="text-center">
                                <th>#{{ $item->meta_key }}</th>
                                <td>{{ nomeUsuario($item->meta_key) }}</td>
                                <th>{{ $item->value }} %</th>
                                <th>
                                    <form method="POST"
                                          action="{{ route('admin.precificacao.vendedor.destroy', $item->id) }}"> @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-tables.table-default>
            </div>
        </div>
    </x-body.card>
</x-layout>
