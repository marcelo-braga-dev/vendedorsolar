<x-layout menu="integracoes" submenu="historico-integracoes">
    <x-body title="Histórico de Integracões" class="p-0">
        <x-tables.table-default>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Origem</th>
                    <th>Fornecedor</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Avisos</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($historicos as $item)
                    <tr>
                        <td>{{ $origens[$item->origem] ?? '' }}</td>
                        <td>{{ $fornecedores[$item->fornecedores_id]->nome ?? '' }}</td>
                        <td>
                            Início: {{ date('d/m/y H:i:s', strtotime($item->created_at)) }}<br>
                            Fim: {{ date('d/m/y H:i:s', strtotime($item->updated_at)) }}
                        </td>
                        <td style="white-space: normal">{{ $item->status }}</td>
                        <td style="white-space: normal">{!! nl2br( $item->alertas) !!}</td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $historicos }}
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
