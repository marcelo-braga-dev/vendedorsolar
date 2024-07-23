<x-layout menu="financeiro" submenu="comissao-venda">
    <x-body title="Taxa de Comissão por Venda" class="p-0">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Comissão</th>
                    <th>Data da Atualização</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($usuarios as $usuario)
                    <tr>
                        <th>
                            #{{ $usuario->id }}
                        </th>
                        <td style="white-space: normal">
                            {{ $usuario->name }}
                        </td>
                        <td>
                            {{ $comissoes[$usuario->id] ?? '' }}%
                        </td>
                        <td>
                            {{ date('d/m/y H:i', strtotime($usuario->created_at) ) }}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success"
                               href="{{ route('admin.financeiro.comissao-venda.edit', $usuario->id) }}">
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

