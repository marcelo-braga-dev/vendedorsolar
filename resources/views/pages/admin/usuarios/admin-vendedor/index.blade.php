<x-layout menu="usuarios" submenu="gerente-vendas">
    <x-body title="Gerente de Vendas Cadastrados"
            text-button="Cadastrar Gerente de Vendas"
            url-button="{{ route('admin.usuarios.admins-vendedores.create') }}" class="p-0">
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
                    <tr class="text-center">
                        <td>
                            #{{ $usuario->id }}
                        </td>
                        <td>
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
{{--                            <a class="btn btn-sm btn-success" href="{{ route('admin.usuarios.admins-vendedores.show', $usuario->id) }}">--}}
{{--                                <i class="fas fa-edit"></i>--}}
{{--                            </a>--}}
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table>
    </x-body>
</x-layout>
