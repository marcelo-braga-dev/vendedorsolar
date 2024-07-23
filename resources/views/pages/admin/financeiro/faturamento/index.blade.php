<x-layout menu="financeiro" submenu="faturamento">
    <x-body title="Faturamento" text-button="Cadastrar Administrador"
            url-button="{{ route('admin.usuarios.admins.create') }}">

        <div class="row mb-5">
            <div class="col-12">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages': ['bar']});
                    google.charts.setOnLoadCallback(drawStuff);

                    function drawStuff() {
                        var data = new google.visualization.arrayToDataTable([
                            ['Vendedor', 'Vendas'],
                                @foreach($orcamentos as $orcamento)
                            ['{{ usuario($orcamento->users_id)->name }}', {{ $orcamento->preco_cliente }}],
                            @endforeach
                        ]);

                        var options = {
                            // width: 800,
                            legend: {position: 'none'},
                            chart: {
                                title: 'Faturamento por Vendedor',
                                subtitle: 'Faturamento mensal'
                            },
                            axes: {
                                x: {
                                    0: {side: 'bottom', label: 'Vendedores'} // Top x-axis.
                                }
                            },
                            bar: {groupWidth: "90%"}
                        };

                        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                        // Convert the Classic options to Material options.
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="top_x_div" style="width: 100%; height: 600px;"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3>Faturamento dos vendedores</h3>
                <x-tables.table-default>
                    <x-slot name="head">
                        <tr>
                            <th>Vendedor</th>
                            <th>Jan</th>
                            <th>Fev</th>
                            <th>Mar</th>
                            <th>Abr</th>
                            <th>Mai</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ago</th>
                            <th>Set</th>
                            <th>Out</th>
                            <th>Nov</th>
                            <th>Dez</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($orcamentos as $item)
                            <tr>
                                <td>{{ usuario($item->users_id)->name }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                                <td>R$ {{ convert_float_money($item->preco_cliente) }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-tables.table-default>
            </div>
        </div>


    </x-body>
</x-layout>
