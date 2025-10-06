<x-layout menu="contratos" submenu="contratos-gerados">
    <x-body title="Contratos Gerados" class="p-0" text-button="Agendar Visita"
            url-button="">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID do <br>Contrato</th>
                    <th>ID do <br>Orçamento</th>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($items as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>#{{ $item->orcamentos_id }}</td>
                        <td>{{ $item->nome_cliente }}</td>
                        <td>Novo</td>
                        <td>{{ date('d/m/y H:i', strtotime($item->created_at)) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('vendedor.contratos.show', $item->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>
</x-layout>


