<x-layout menu="produtos" submenu="inversores">
    <x-body title="Inversores" class="p-0" text-button="Cadastrar Marca de Inversor"
            url-button="{{ route('admin.produtos.inversores.create') }}">
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
                @foreach($inversores as $item)
                    <tr>
                        <td><img src="{{ asset('storage') . '/' . $item->img_produto }}" width="60" alt="logo"></td>
                        <th><b>{{ $item->nome }}</b></th>
                        <td><img src="{{ asset('storage') . '/' . $item->img_logo }}" width="60" alt="logo"></td>
                        <td>
                            <a class="btn btn-sm btn-success"
                               href="{{ route('admin.produtos.inversores.edit', $item->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
