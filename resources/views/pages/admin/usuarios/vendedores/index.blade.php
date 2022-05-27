<x-layout menu="usuarios" submenu="vendedores">
    <x-body title="Vendedores Cadastrados" text-button="Cadastrar Vendedor"
            url-button="{{ route('admin.usuarios.vendedores.create') }}" class="p-0">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
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
                        <th>
                            #{{ $usuario->id }}
                        </th>
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
                            <a class="btn btn-sm btn-success" href="{{ route('admin.usuarios.vendedores.show', $usuario->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $usuarios }}
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
