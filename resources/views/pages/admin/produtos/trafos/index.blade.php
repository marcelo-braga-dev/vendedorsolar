<x-layout menu="produtos" submenu="trafos">
    <x-body title="Transformadores" class="p-0" text-button="Marcas de Transformadores"
            url-button="{{ route('admin.produtos.trafos-marcas.index') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Produto</th>
                    <th>Preços</th>
                    <th>Margem</th>
                    <th>Imagens</th>
                    <th>Status Forn.</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($trafos as $item)
                    <tr>
                        <td style="white-space: normal">
                            <b>Código: {{ $item->sku }}</b><br>
                            {{ $item->modelo }}</td>
                        <td>
                            Cliente: R$ {{ convert_float_money($item->preco_cliente) }}<br>
                            Forn.: R$ {{ convert_float_money($item->preco_fornecedor) }}
                        </td>
                        <td>{{ $item->margem }}%</td>
                        <td>
                            <img src="{{ asset('storage') . '/' . $img[$item->produtos_id]->img_produto }}" width="120" alt="logo">
                        </td>
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
