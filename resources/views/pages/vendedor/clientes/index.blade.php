<x-layout menu="clientes" submenu="cadastrados">
    <x-body title="Seus Clientes Cadastrados" class="p-0">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Cidade/Estado</th>
                    <th>Data do Cadastro</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($clientes as $cliente)
                    <tr>
                        <td>#{{ $cliente->id }}</td>
                        <td>{{ getNomeCliente($cliente->id) }}</td>
                        <td>{{ getStatusCliente($cliente->status) }}</td>
                        <td>{{ getCidadeEstado($cliente->cidades_estados_id) }}</td>
                        <td>{{ date('d/m/y H:i', strtotime($cliente->created_at)) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('vendedor.clientes.show', $cliente->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>
    @push('js')
        <script>
            $(function () {
                $('#cliente-pesquisar').change(function () {
                    $('#form-pesquisa').submit();
                })
            });
        </script>
    @endpush
</x-layout>


