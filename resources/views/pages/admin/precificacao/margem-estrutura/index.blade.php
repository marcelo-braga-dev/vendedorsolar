<x-layout menu="margens" submenu="margem-estrutura">
    <x-body title="Margem por Estrutura">
        <form method="POST" action="{{ route('admin.precificacao.estrutura.store') }}"> @csrf
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <x-inputs.select label="Estruturas" name="estrutura" required>
                        <option value=""></option>
                        @foreach($estruturas as $estrutura)
                            <option value="{{ $estrutura->id }}">{{ $estrutura->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="Margem" name="margem" type="number"
                                              step="0.001" required></x-inputs.input-box-right>
                </div>
                <div class="col-md-3 align-self-center">
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
    <x-body.card title="Margens Cadastradas">
        <div class="row justify-content-center">
            <div class="col-12">
                <x-tables.table-default>
                    <x-slot name="head">
                        <tr class="text-center">
                            <th>Estruturas</th>
                            <th>Margem</th>
                            <th></th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($margens as $margem)
                            <tr class="text-center">
                                <td>{{ $nomeEstruturas[$margem->meta_key] }}</td>
                                <th>{{ $margem->value }}%</th>
                                <th>
                                    <form method="POST"
                                          action="{{ route('admin.precificacao.estrutura.destroy', $margem->id) }}"> @csrf @method('DELETE')
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
