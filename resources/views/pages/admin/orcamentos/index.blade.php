<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Todos Orçamentos Gerados" class="p-0">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Data Criação</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($orcamentos as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $vendedor[$item->users_id] }}</td>
                        <td>{{ $cliente[$item->clientes_id] }}</td>
                        <td>{{ $item->status }}</td>
                        <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                        <td>{{ date('d/m/y H:i', strtotime($item->created_at)) }}</td>
                        <td>
                            <a href="{{route('admin.orcamentos.show', $item->id)}}">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $orcamentos }}
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
