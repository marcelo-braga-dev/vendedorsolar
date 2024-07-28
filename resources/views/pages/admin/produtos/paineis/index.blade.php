<x-layout menu="produtos" submenu="paineis">
    <x-body title="Paineis" class="p-0" text-button="Cadastrar Marca de Painel"
            url-button="{{ route('admin.produtos.paineis.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th style="width: 50px">Produto</th>
                    <th>Marcas</th>
                    <th>Logo</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($paineis as $item)
                    <tr>
                        <td><img src="{{ asset('storage') . '/' . $item->img_produto }}" height="80" alt="logo"></td>
                        <td><b>{{ $item->nome }}</b></td>
                        <td><img src="{{ asset('storage') . '/' . $item->img_logo }}" width="50" alt="logo"></td>
                        <td>
                            <a class="btn btn-sm btn-success"
                               href="{{ route('admin.produtos.paineis.edit', $item->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
