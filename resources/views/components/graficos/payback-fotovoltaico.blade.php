<div id="grafico-payback" style="overflow-x: auto"></div>
<p class="text-center" style="font-size:13px;color:#555;">
    Investimento: <strong>R$ {{ number_format($precoCliente, 2, ',', '.') }}</strong>
    @if($anoPayback !== null)
        &nbsp;|&nbsp; Payback estimado: <strong>{{ number_format($anoPayback, 1, ',', '.') }} anos</strong>*
    @else
        &nbsp;|&nbsp; Payback estimado além do horizonte de 25 anos projetado*
    @endif
</p>
<p class="text-center" style="font-size:11px;color:#888;">
    *Estimativa com base em degradação, inflação energética e Fio B (Lei 14.300/2022) configurados pelo administrador. Não constitui garantia de retorno financeiro.
</p>

@push('js')
<script>
    let fluxoCaixa = @json($fluxo);

    google.charts.load("current", {
        packages: ['corechart'],
        'language': 'pt-br'
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var linhas = [['Ano', 'Saldo Acumulado', { role: 'style' }]];
        fluxoCaixa.forEach(function (item) {
            linhas.push([String(item.ano), item.acumulado, item.cor]);
        });

        var payback = google.visualization.arrayToDataTable(linhas);

        var valores = fluxoCaixa.map(function (item) { return item.acumulado; });
        var maxValor = Math.max.apply(null, valores);
        var minValor = Math.min.apply(null, valores);

        const options_payback = {
            height: 400,
            width: 800,
            chartArea: {
                left: 100,
                top: 50,
                width: '90%',
                height: '75%'
            },
            legend: { position: "none" },
            bar: { groupWidth: '80%' },
            title: 'Payback do Investimento*',
            fontSize: 12,
            hAxis: {
                title: 'Anos',
                textStyle: {
                    color: 'black',
                    fontSize: 13
                },
                titleTextStyle: {
                    fontSize: 22,
                    color: 'black',
                    bold: true,
                    italic: true
                }
            },
            colors: ['red', '#bac405'],
            vAxis: {
                format: 'currency',
                viewWindow: {
                    max: maxValor,
                    min: minValor
                },
                titleTextStyle: {
                    fontSize: 18,
                    color: 'black',
                    bold: true
                }
            }
        };

        //Grafico Payback
        var chartContainer = document.getElementById('grafico-payback');
        chart = new google.visualization.ColumnChart(chartContainer);

        google.visualization.events.addListener(chart, 'ready', function () {
            $('#grafico_payback').val(chart.getImageURI());
            document.getElementById('grafico_payback').value = chart.getImageURI();
        });

        chart.draw(payback, options_payback);
    }
</script>
@endpush
