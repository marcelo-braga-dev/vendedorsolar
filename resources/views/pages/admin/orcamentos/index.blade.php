<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="{{ $label }}" class="p-0">
        <x-tables.table-clickable>
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
                        <td>{{ $cliente[$item->clientes_id] }}</td>
                        <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                        <td>{{ getStatusOrcamentos($item->status) }}</td>
                        <td><a href="{{route('admin.orcamentos.show', $item->id)}}">Ver</a></td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $orcamentos }}
            </x-slot>
        </x-tables.table-clickable>
        @if (!empty($orcamentos->isEmpty()))
            <div class="row">
                <small class="text-muted mx-auto p-3">Não há registro de orçamentos</small>
            </div>
        @endif
    </x-body>
</x-layout>
