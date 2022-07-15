<x-layout menu="produtos" submenu="trafos">
    <x-body title="Transformadores" class="p-0" text-button="Voltar"
            url-button="{{ route('admin.produtos.trafos.index') }}">
        <div class="row justify-content-end">
            <div class="col-auto mb-3">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.produtos.trafos-marcas.create') }}">Cadastras Nova Marca</a>
            </div>
        </div>
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
                @foreach($trafos as $item)
                    <tr>
                        <td>{{ $item->nome }}</td>
                        <td><img src="{{ asset('storage') . '/' . $item->img_logo }}" width="120" alt="logo"></td>
                        <td><img src="{{ asset('storage') . '/' . $item->img_produto }}" width="120" alt="logo"></td>
                        <td style="white-space: normal">{{ $item->garantia }}</td>
                        <td>
                            <a class="btn btn-sm btn-success"
                               href="{{ route('admin.produtos.trafos-marcas.edit', $item->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.table-default>
    </x-body>
</x-layout>
