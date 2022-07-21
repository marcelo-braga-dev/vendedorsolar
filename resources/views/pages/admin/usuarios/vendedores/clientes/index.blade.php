<x-layout menu="usuarios" submenu="vendedores">
    <x-body title="Clientes Cadastrados" url-button="{{ route('admin.usuarios.vendedores.index') }}" class="p-0">
        <x-tables.table-default>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Cliente</th>
                    <th>Cidade/Estado</th>
                    <th>Data do Cadastro</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($clientes as $cliente)
                    <tr class="text-center">
                        <td style="white-space: normal">
                            {{ getNomeCliente($cliente->id) }}
                        </td>
                        <td>
                            {{ getCidadeEstado($cliente->cidades_estados_id) }}
                        </td>
                        <td>
                            {{ date('d/m/y H:i', strtotime($cliente->created_at) ) }}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.usuarios.vendedor.clientes.show', $cliente->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $clientes }}
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
