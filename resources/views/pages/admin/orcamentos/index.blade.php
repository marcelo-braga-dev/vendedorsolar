<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="{{ $label }}" class="p-0">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Data Criação</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($orcamentos as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>
                            {{ date('d/m/y', strtotime($item->created_at)) }}<br>
                            {{ date('H:i:s', strtotime($item->created_at)) }}
                        </td>
                        <td><b>{{ $vendedor[$item->users_id] }}</b></td>
                        <td>{{ getNomeCliente($item->clientes_id) }}</td>
                        <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                        <td>{{ getStatusOrcamentos($item->status) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('admin.orcamentos.show', $item->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>
</x-layout>
