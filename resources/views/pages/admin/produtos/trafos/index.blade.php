<x-layout menu="produtos" submenu="trafos">
    <x-body title="Transformadores" class="p-0" text-button="Marcas de Transformadores"
            url-button="{{ route('admin.produtos.trafos-marcas.index') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Status Forn.</th>
                    <th>Produto</th>
                    <th>Preços</th>
                    <th>Imagens</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($trafos as $item)
                    <tr>
                        <td class="text-center">
                            @if ($item->status_fornecedor)
                                <i class="fas fa-check-circle text-success text-lg"></i>
                            @else
                                <i class="fas fa-times-circle text-danger text-lg"></i>
                            @endif
                        </td>
                        <td style="white-space: normal">
                            <b>Código: {{ $item->sku }}</b><br>
                            <b>Potência: {{ $item->potencia }} kVA</b><br>
                            {{ $item->modelo }}</td>
                        <td>
                            <b>Cliente: R$ {{ convert_float_money($item->preco_cliente) }}</b><br>
                            Forn.: R$ {{ convert_float_money($item->preco_fornecedor) }}<br>
                            Margem: {{ $item->margem }}%
                        </td>
                        <td>
                            <img src="{{ asset('storage') . '/' . $img[$item->produtos_id]->img_produto }}" width="120"
                                 alt="logo">
                        </td>
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
