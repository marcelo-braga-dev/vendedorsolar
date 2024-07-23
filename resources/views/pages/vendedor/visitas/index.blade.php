<x-layout menu="visita" submenu="agendadas">
    <x-body title="Seus Visitas Agendadas" class="p-0" text-button="Agendar Visita"
            url-button="{{ route('vendedor.visitas.create') }}">
        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th>Data da Visita</th>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach($visitas as $item)
                    <tr>
                        <td>{{ date('d/m/y H:i', strtotime($item->data)) }}</td>
                        <td>{{ getNomeCliente($item->clientes_id) }}</td>
                        <td>{{ getStatusVisitaTecnica($item->status) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('vendedor.visitas.show', $item->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>
</x-layout>


