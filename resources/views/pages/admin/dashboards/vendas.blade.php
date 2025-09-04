<x-layout menu="dashboards" submenu="dashboards-vendas">
    <x-body title="Dashboard de Vendas" class="p-4">

        {{-- Cards --}}
        @php
            $totalVendas = array_sum(array_column($ranking,'vendas'));
            $ticketMedio = round(array_sum(array_column($ranking,'valor')) / max($totalVendas,1), 2);
        @endphp
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0"><div class="card-body text-center">
                        <small class="text-muted">Total de Vendas (itens)</small>
                        <h3 class="mb-0">{{ $totalVendas }}</h3>
                    </div></div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0"><div class="card-body text-center">
                        <small class="text-muted">Ticket Médio</small>
                        <h3 class="mb-0">R$ {{ number_format($ticketMedio,2,',','.') }}</h3>
                    </div></div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0"><div class="card-body text-center">
                        <small class="text-muted">Vendedores Ativos</small>
                        <h3 class="mb-0">{{ count($ranking) }}</h3>
                    </div></div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Ranking por Valor</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="expRank">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartRanking"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Funil de Vendas</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="expFunil">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartFunil"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Origem dos Leads</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="expOrigem">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartOrigem"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </x-body>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script>
            const ranking  = @json($ranking);
            const rkNames  = ranking.map(r=>r.vendedor);
            const rkValues = ranking.map(r=>r.valor);

            new Chart(document.getElementById('chartRanking'), {
                type: 'bar',
                data: { labels: rkNames, datasets: [{ label: 'R$ em vendas', data: rkValues, backgroundColor: '#0ea5e9' }] },
                options: { responsive:true, plugins:{ legend:{display:false}}, scales:{ y:{ ticks:{ callback:v=>'R$ '+v.toLocaleString('pt-BR')}}}}
            });

            const funil = @json($funil);
            new Chart(document.getElementById('chartFunil'), {
                type: 'bar',
                data: { labels: Object.keys(funil), datasets: [{ label: 'Qtde', data: Object.values(funil), backgroundColor: '#f59e0b' }] },
                options: { indexAxis: 'y', plugins:{ legend:{display:false} } }
            });

            const origens = @json($origens);
            new Chart(document.getElementById('chartOrigem'), {
                type: 'doughnut',
                data: { labels: Object.keys(origens), datasets:[{ data:Object.values(origens) }] },
                options: { responsive:true }
            });

            // Excel
            document.getElementById('expRank').onclick = () => {
                const rows = ranking.map(r=>({ Vendedor:r.vendedor, Vendas:r.vendas, Valor:r.valor }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Ranking');
                XLSX.writeFile(wb, 'vendas_ranking.xlsx');
            };
            document.getElementById('expFunil').onclick = () => {
                const rows = Object.keys(funil).map(k=>({ Etapa:k, Quantidade: funil[k] }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Funil');
                XLSX.writeFile(wb, 'vendas_funil.xlsx');
            };
            document.getElementById('expOrigem').onclick = () => {
                const rows = Object.keys(origens).map(k=>({ Origem:k, Quantidade: origens[k] }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Origens');
                XLSX.writeFile(wb, 'vendas_origens.xlsx');
            };
        </script>
    @endpush
</x-layout>
