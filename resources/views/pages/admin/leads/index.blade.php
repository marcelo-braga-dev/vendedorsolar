<x-layout menu="leads" submenu="novos">
    <x-body title="Leads captados no site" class="p-0">
        <div class="row">
            <div class="col-12">
                <x-tables.table-default>
                    <x-slot name="head">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cidade/Estado</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th></th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($clientes as $item)
                            <tr>
                                <th>#{{ $item->id }}</th>
                                <td>{{ get_nome_cliente($item->id) }}</td>
                                <td>{{ getCidadeEstado($item->cidades_estados_id) }}</td>
                                <td>Novo</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-tables.table-default>
            </div>
        </div>
    </x-body>
</x-layout>
