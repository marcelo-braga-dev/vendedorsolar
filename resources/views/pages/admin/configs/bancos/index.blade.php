<x-layout menu="financeiro" submenu="bancos">
    <x-body title="Bancos" class="p-0" text-button="Cadastrar Banco"
            url-button="{{ route('admin.configs.bancos.create') }}">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr>
                    <th>Banco</th>
                    <th>Qtd. Parcelas</th>
                    <th>Juros Mensal</th>
                    <th>Carência</th>
                    <th>Status</th>
                    <th>Logo</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($bancos as $item)
                    <tr>
                        <th>{{ $item->nome }}</th>
                        <td class="text-center">{{ $item->qtd_parcelas }} x</td>
                        <td class="text-center">{{ $item->juros_mensal }}%</td>
                        <td class="text-center">{{ $item->carencia }} meses</td>
                        <td>{{ get_status($item->status) }}</td>
                        <td>
                            <img src="{{ asset('storage') . '/' . $item->img_logo }}" alt="logo" width="80">
                        </td>
                        <td>
                            <a href="{{ route('admin.configs.bancos.edit', $item->id )}}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
