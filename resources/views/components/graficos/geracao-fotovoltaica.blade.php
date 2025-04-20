<div id="grafico-geracao" style="overflow-x: auto"></div>

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(function () {
            let geracaoMensal = @json($geracaoMensal);
            const corBarra = 'rgb(15,145,210)';

            google.charts.load("current", {
                packages: ['corechart'],
                'language': 'pt-br'
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var geracao = google.visualization.arrayToDataTable([
                    ['Mês', 'Geração de Energia', {role: 'style'}],
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
                        width: '90%',
                        height: '75%'
                    },
                    legend: { position: "none" },
                    bar: { groupWidth: '80%' },
                    title: 'Geração Mensal de Energia*',
                    fontSize: 16,
                    vAxis: {
                        title: 'kWh',
                        minValue: 0,
                        titleTextStyle: {
                            fontSize: 18,
                            color: 'black',
                            bold: true
                        }
                    }
                };

                const chartContainer = document.getElementById('grafico-geracao');
                const chart = new google.visualization.ColumnChart(chartContainer);

                // Captura a imagem assim que o gráfico estiver pronto
                google.visualization.events.addListener(chart, 'ready', function () {
                    const imageData = chart.getImageURI();
                    document.getElementById('grafico_geracao').value = imageData;
                });

                chart.draw(geracao, options);
            }
        });
    </script>
@endpush
