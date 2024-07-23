<x-layout menu="usuarios" submenu="vendedores">
    <x-body title="Vendedores Cadastrados" text-button="Cadastrar Vendedor"
            url-button="{{ route('admin.usuarios.vendedores.create') }}" class="p-0">
        <x-tables.data-table>
            <x-slot name="head">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data do Cadastro</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>
                            #{{ $usuario->id }}
                        </td>
                        <td class="text-center">
                            @if ($usuario->status)
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        <td style="white-space: normal">
                            {{ $usuario->name }}
                        </td>
                        <td>
                            {{ $usuario->email }}
                        </td>
                        <td>
                            {{ date('d/m/y H:i', strtotime($usuario->created_at) ) }}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning m-1"
                               href="{{ route('admin.usuarios.vendedor.clientes', $usuario->id) }}">
                                <i class="fas fa-users"></i>
                            </a>
                            <a class="btn btn-sm btn-primary m-1"
                               href="{{ route('admin.usuarios.vendedores.show', $usuario->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table>
    </x-body>
</x-layout>
