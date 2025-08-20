<x-layout menu="orcamentos" submenu="servicos">
    <x-body title="Propostas de Serviços" class="p-0">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th class="col-1">ID</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Titulo</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($propostas as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td style="white-space: normal">
                            {{ $item->cliente->nome ?? $item->cliente->razao_social }}
                        </td>
                        <td>
                            R$ {{ convert_float_money($item->valor) }}
                        </td>
                        <td>{{ $item->titulo }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('vendedor.servicos.show', $item->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>
</x-layout>



