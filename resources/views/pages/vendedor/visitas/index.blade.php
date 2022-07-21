<x-layout menu="visita" submenu="agendadas">
    <x-body title="Seus Visitas Agendadas" class="p-0">
        <div class="row justify-content-end mb-3 mx-3">
            <a class="btn btn-primary" href="{{ route('vendedor.visitas.create') }}">Agendar Visita</a>
        </div>
        <x-tables.table-default>
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
                        <td><a href="{{ route('vendedor.visitas.show', $item->id) }}">Ver</a></td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot name="paginate">
                {{--                {{ $visitas }}--}}
            </x-slot>
        </x-tables.table-default>
        @if ($visitas->isEmpty())
            <div class="col-auto text-center py-3">
                <small class="text-muted">Não há registros.</small>
            </div>
        @endif
    </x-body>
</x-layout>


