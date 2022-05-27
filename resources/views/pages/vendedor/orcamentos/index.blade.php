<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Seus Clientes Cadastrados" class="p-0">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Consumo</th>
                    <th>Geração</th>
                    <th>Status</th>
                    <th>Criado Dia</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($orcamentos as $orcamento)
                    <tr>
                        <th>#{{ $orcamento->id }}</th>
                        <td>{{ get_nome_cliente($orcamento->clientes_id) }}</td>
                        <td>R$ {{ convert_float_money($orcamento->preco_cliente) }}</td>
                        <td>{{ $orcamento->consumo }} kWh/mês</td>
                        <td>{{ $orcamento->geracao }} kWh/mês</td>
                        <td>{{ $orcamento->status }}</td>
                        <td>{{ date('d/m/y H:i', strtotime($orcamento->created_at) ) }}</td>
                        <td>
                            <a href="{{ route('vendedor.orcamento.show', $orcamento->id) }}">
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $orcamentos }}
            </x-slot>
        </x-tables.table-clickable>
        @if ($orcamentos->isEmpty())
            <div class="row">
                <div class="col-auto mx-auto mb-3">
                    <small>Não há histórico de orçamentos</small>
                </div>
            </div>
        @endif
    </x-body>
</x-layout>



