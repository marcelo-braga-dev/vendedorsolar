<x-layout menu="integracoes" submenu="historico-integracoes">
    <x-body title="Histórico de Integracões" class="p-0">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Status</th>
                    <th>Avisos</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($historicos as $item)
                    <tr class="text-center">
                        <td>{{ date('d/m/y h:i:s', strtotime($item->created_at)) }}</td>
                        <td>{{ date('d/m/y h:i:s', strtotime($item->updated_at)) }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{!! nl2br( $item->alertas) !!}</td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $historicos }}
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
