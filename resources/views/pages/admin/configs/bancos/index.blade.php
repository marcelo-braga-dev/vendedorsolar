<x-layout menu="financeiro" submenu="bancos">
    <x-body title="Bancos" class="p-0" text-button="Cadastrar Banco"
            url-button="{{ route('admin.configs.bancos.create') }}">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr class="text-center">
                    <th>Status</th>
                    <th>Banco</th>
                    <th>Qtd. Parcelas</th>
                    <th>Juros Mensal</th>
                    <th>Carência</th>
                    <th>Logo</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($bancos as $item)
                    <tr class="text-center">
                        <td>
                            @if ($item->status)
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        <th>{{ $item->nome }}</th>
                        <td class="text-center">{{ $item->qtd_parcelas }} x</td>
                        <td class="text-center">{{ $item->juros_mensal }}%</td>
                        <td class="text-center">{{ $item->carencia }} meses</td>
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
