<div id="grafico-geracao" style="overflow-x: auto"></div>

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(function () {
            let geracaoMensal = {{ Js::from($geracaoMensal) }};
            const corBarra = 'rgb(15,145,210)';

            google.charts.load("current", {
                packages: ['corechart'],
                'language': 'pt-br'
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var geracao = google.visualization.arrayToDataTable([
                    ['Mês', 'Gerao de Energia', {role: 'style'}],
                    ['Jan', geracaoMensal.jan, corBarra],
                    ['Fev', geracaoMensal.fev, corBarra],
                    ['Mar', geracaoMensal.mar, corBarra],
                    ['Abr', geracaoMensal.abr, corBarra],
                    ['Mai', geracaoMensal.mai, corBarra],
                    ['Jun', geracaoMensal.jun, corBarra],
                    ['Jul', geracaoMensal.jul, corBarra],
                    ['Ago', geracaoMensal.ago, corBarra],
                    ['Set', geracaoMensal.set, corBarra],
                    ['Out', geracaoMensal.out, corBarra],
                    ['Nov', geracaoMensal.nov, corBarra],
                    ['Dez', geracaoMensal.dez, corBarra],
                ]);

                var options = {
                    height: 400,
                    width: 800,
                    chartArea: {
                        left: 80,
                        top: 50,
                        'width': '90%',
                        'height': '75%'
                    },
                    legend: {
                        position: "none"
                    },
                    bar: {
                        groupWidth: '80%'
                    },
                    title: 'Geração Mensal de Energia*',
                    bold: true,
                    fontSize: 16,
                    series: {
                        1: {
                            type: 'line'
                        }
                    },
                    vAxis: {
                        format: ' ',
                        title: 'kWh',
                        viewWindow: {
                            //max: 15,
                            min: 0
                        },
                        titleTextStyle: {
                            fontSize: 18,
                            color: 'black',
                            bold: true
                        }
                    },
                };

                var view = new google.visualization.DataView(geracao);

                var g_chart_1 = document.getElementById('grafico-geracao');
                g_chart_1 = new google.visualization.ColumnChart(g_chart_1);

                google.visualization.events.addListener(g_chart_1, 'ready', function () {
                    $('#grafico_geracao').val(g_chart_1.getImageURI());
                });

                g_chart_1.draw(view, options);
            }
        });
    </script>
@endpush
