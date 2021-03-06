<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Orçamentos Gerados" class="p-0">
        <form action="{{ route('vendedor.orcamento.index') }}">
            <div class="row justify-content-end">
                <div class="col-6 col-md-5">
                    <x-inputs.select label="" name="cliente">
                        <option value=" ">Todos Clientes</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                    @if ($cliente->id == $idCliente) selected @endif>
                                {{ getNomeCliente($cliente->id) }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-auto col-md-auto">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
            </div>
        </form>

        <x-tables.table-clickable>
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
                        <th>#{{ $orcamento->id }}</th>
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



