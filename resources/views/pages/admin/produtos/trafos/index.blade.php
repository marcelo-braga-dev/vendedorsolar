<x-layout menu="produtos" submenu="trafos">
    <x-body title="Transformadores" class="p-0" text-button="Editar Marca"
            url-button="{{ route('admin.produtos.trafos.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Produto</th>
                    <th>Potências</th>
                    <th>Preço Cliente</th>
                    <th>Preço Fornecedor</th>
                    <th>Margem</th>
                    <th>Status Forn.</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($trafos as $item)
                    <tr>
                        <th style="white-space: normal">{{ $item->modelo }}</th>
                        <td>{{ $item->potencia }} kW</td>
                        <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                        <td>R$ {{ convert_float_money($item->preco_fornecedor) }}</td>
                        <td>{{ $item->margem }}%</td>
                        <td>{{ get_status($item->status_fornecedor) }}</td>
                        <td>
                            <a class="btn btn-sm btn-success"
                               href="{{ route('admin.produtos.trafos.edit', $item->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
