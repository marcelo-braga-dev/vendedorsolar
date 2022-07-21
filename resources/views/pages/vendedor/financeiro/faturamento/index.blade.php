<x-layout menu="financeiro" submenu="faturamento">
    <x-body title="Faturamento">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">
                                    Faturamento Total
                                </h5>
                                <span class="h2 font-weight-bold mb-0">
                                    R$ {{ convert_float_money($faturamentoTotal) }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                            <span class="text-nowrap">de faturamento</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">
                                    Pagos
                                </h5>
                                <span class="h2 font-weight-bold mb-0">
                                    R$ 0,00
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"></span>
                            <span class="text-nowrap"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
                            ['{{ date('d/m/y', strtotime($orcamento->created_at)) }}', {{ $orcamento->preco_cliente }}],
                            @endforeach
                        ]);

                        var options = {
                            // width: 800,
                            legend: {position: 'none'},
                            chart: {
                                title: 'Seu Faturamento',
                                subtitle: 'Faturamento mensal'
                            },
                            axes: {
                                x: {
                                    0: {side: 'bottom', label: 'Vendedores'} // Top x-axis.
                                }
                            },
                            bar: {groupWidth: "70%"}
                        };

                        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                        // Convert the Classic options to Material options.
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="top_x_div" style="width: 100%; height: 400px;"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <x-tables.table-clickable>
                    <x-slot name="head">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Data</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($orcamentos as $orcamento)
                            <tr>
                                <td>#{{ $orcamento->id }}</td>
                                <td>Em aberto</td>
                                <td>{{ getNomeCliente($orcamento->clientes_id) }}</td>
                                <td>R$ {{ convert_float_money($orcamento->preco_cliente) }}</td>
                                <td>{{ date('d/m/y', strtotime($orcamento->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-tables.table-clickable>
            </div>
        </div>
        @if ($orcamentos->isEmpty())
            <div class="row">
                <div class="col text-center p-3">
                    <small class="text-muted">Não há histórico</small>
                </div>
            </div>
        @endif
    </x-body>
</x-layout>
