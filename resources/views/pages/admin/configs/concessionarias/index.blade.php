<x-layout menu="configs" submenu="concessionarias">
    <x-body title="Concessionarias" class="p-0">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Estado</th>
                    <th class="text-left">Empresa</th>
                    <th>Tarifa Ponta</th>
                    <th>Tarifa Fora de Ponta</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($items as $item)
                    <tr>
                        <th class="text-center">{{ $item->estado }}</th>
                        <td>{{ $item->nome }}</td>
                        <td>R$ {{ convert_float_money($item->ponta, 5) }}</td>
                        <td class="text-center">R$ {{ convert_float_money($item->fora_ponta, 5) }}</td>
                        <td>
                            <a href="{{ route('admin.configs.concessionarias.edit', $item->id )}}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $items }}
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
