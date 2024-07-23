<x-layout menu="fornecedores" submenu="fornecedores_cadastrados">
    <x-body title="Fornecedores Cadastrados" class="p-0"
            text-button="Cadastrar Fornecedor" url-button="{{ route('admin.fornecedores.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Empresa</th>
                    <th>Representante</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($fornecedores as $item)
                    <tr>
                        <td><b>{{ $item->nome }}</b></td>
                        <td>{{ $item->representante }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->celular ?? '-' }}</td>
                        <td>{{ $item->telefone ?? '-' }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.fornecedores.show', $item->id) }}">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
