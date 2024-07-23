<div id="grafico-payback" style="overflow-x: auto"></div>

@push('js')
<script>
    let precoCliente = {{ $precoCliente }};
    google.charts.load("current", {
        packages: ['corechart'],
        'language': 'pt-br'
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var payback = google.visualization.arrayToDataTable([
            ['Ano', 'Gerao de Energia', { role: 'style' }],
            ['1', precoCliente / -1.1666, 'red'],
            ['2', precoCliente / -1.4577, 'red'],
            ['3', precoCliente / -2.0713, 'red'],
            ['4', precoCliente / -4.1070, 'red'],
            ['5', precoCliente / 27.4617, 'green'],
            ['6', precoCliente / 2.7628, 'green'],
            ['7', precoCliente / 1.3537, 'green'],
            ['8', precoCliente / 0.8526, 'green'],
            ['9', precoCliente / 0.5983, 'green'],
            ['10', precoCliente / 0.4461, 'green'],
            ['11', precoCliente / 0.3457, 'green'],
            ['12', precoCliente / 0.2752, 'green'],
            ['13', precoCliente / 0.2235, 'green'],
            ['14', precoCliente / 0.1843, 'green'],
            ['15', precoCliente / 0.1537, 'green'],
            ['16', precoCliente / 0.1295, 'green'],
            ['17', precoCliente / 0.1100, 'green'],
            ['18', precoCliente / 0.0940, 'green'],
            ['19', precoCliente / 0.0809, 'green'],
            ['20', precoCliente / 0.0699, 'green'],
            ['21', precoCliente / 0.0606, 'green'],
            ['22', precoCliente / 0.0528, 'green'],
            ['23', precoCliente / 0.0461, 'green'],
            ['24', precoCliente / 0.0404, 'green'],
            ['25', precoCliente / 0.0355, 'green']
        ]);

        var options_payback = {
            height: 400,
            width: 800,
            chartArea: {
                left: 100,
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
            title: 'Payback do Investimentos*',
            //bold: true,
            fontSize: 12,
            //series: {1: {type: 'line'}},
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
                    max: precoCliente / 0.0355,
                    min: precoCliente / -1.1666
                },
                titleTextStyle: {
                    fontSize: 18,
                    color: 'black',
                    bold: true
                },

            },
        };

        //Grafico Payback
        var g_chart_2 = document.getElementById('grafico-payback');
        g_chart_2 = new google.visualization.ColumnChart(g_chart_2);
        google.visualization.events.addListener(g_chart_2, 'ready', function () {
            $('#grafico_payback').val(g_chart_2.getImageURI());
        });
        g_chart_2.draw(payback, options_payback);

    }
</script>
@endpush
