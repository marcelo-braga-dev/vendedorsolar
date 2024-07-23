<x-layout menu="leads" submenu="{{ $status }}">
    <x-body title="Leads captados no site" class="p-0">
        <x-tables.table-clickable>
            <x-slot name="head">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Cidade/Estado</th>
                    <th>Origem</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($leads as $item)
                    <tr class="text-center">
                        <th>#{{ $item->id }}</th>
                        <td>{{ $item->nome }}</td>
                        <td class="text-left">
                            Tel: {{ $item->telefone ?? '-' }}<br>
                            E-mail: {{ $item->email ?? '-' }}
                        </td>
                        <td>{{ getCidadeEstado($item->cidade) }}</td>
                        <td>{{ $item->origem ?? '-' }}</td>
                        <td>{{ getStatusLead($item->status) }}</td>
                        <td>
                            {{ date('d/m/y', strtotime($item->created_at)) }}<br>
                            {{ date('H:i:s', strtotime($item->created_at)) }}
                        </td>
                        <td>
                            <a href="{{ route('admin.leads.show', $item->id) }}">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{ $leads }}
            </x-slot>
        </x-tables.table-clickable>
    </x-body>
</x-layout>
