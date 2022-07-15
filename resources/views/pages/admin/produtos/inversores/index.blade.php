<x-layout menu="produtos" submenu="inversores">
    <x-body title="Inversores" class="p-0" text-button="Cadastrar Marca de Inversor"
            url-button="{{ route('admin.produtos.inversores.create') }}">
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th>Marcas</th>
                    <th>Logo</th>
                    <th>Produto</th>
                    <th>Garantia</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($inversores as $item)
                    <tr>
                        <th>{{ $item->nome }}</th>
                        <td><img src="{{ asset('storage') . '/' . $item->img_logo }}" width="120" alt="logo"></td>
                        <td><img src="{{ asset('storage') . '/' . $item->img_produto }}" width="120" alt="logo"></td>
                        <td style="white-space: normal">{{ $item->garantia }}</td>
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
