<x-layout menu="clientes" submenu="cadastrados">
    <x-body title="Seus Clientes Cadastrados" class="p-0">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cidade/Estado</th>
                    <th>Data do Cadastro</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($clientes as $cliente)
                    <tr>
                        <th>#{{ $cliente->id }}</th>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ getCidadeEstado($cliente->cidades_estados_id) }}</td>
                        <td>{{ date('d/m/y H:i', strtotime($cliente->created_at)) }}</td>
                        <td><a href="{{ route('vendedor.clientes.show', $cliente->id) }}">Ver</a></td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $clientes }}
            </x-slot>
        </x-tables.table-default>
        @if ($clientes->isEmpty())
            <div class="col-auto text-center py-3">
                <span class="text-muted">Não há clientes cadastrados.</span>
            </div>
        @endif
    </x-body>
</x-layout>


