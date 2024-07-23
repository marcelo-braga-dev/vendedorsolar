<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Orçamentos Gerados" class="p-0">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Dados</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($orcamentos as $orcamento)
                    <tr>
                        <td>#{{ $orcamento->id }}</td>
                        <td>
                            {{ date('d/m/y', strtotime($orcamento->created_at) ) }}<br>
                            {{ date('H:i:s', strtotime($orcamento->created_at) ) }}
                        </td>
                        <td style="white-space: normal">
                            <b>{{ getNomeCliente($orcamento->clientes_id) }}</b>
                        </td>
                        <td>R$ {{ convert_float_money($orcamento->preco_cliente) }}</td>
                        <td>
                            @if ($orcamento->consumo)
                                Consumo: {{ $orcamento->consumo }} kWh/mês<br>
                            @endif
                            Geração: {{ $orcamento->geracao }} kWh/mês
                        </td>
                        <td>{{ getStatusOrcamentos($orcamento->status)  }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('vendedor.orcamento.show', $orcamento->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>
</x-layout>



