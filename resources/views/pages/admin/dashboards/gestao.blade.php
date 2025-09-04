<x-layout menu="dashboards" submenu="dashboards-gestao">
    <x-body title="Dashboard de Gestão" class="p-4">

        <div class="row g-3">
            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Propostas por Status</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="expProp">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartPropostas"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Contratos (Ativos x Encerrados)</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="expContratos">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartContratos"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Serviços por Tipo (últimos meses)</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="expServicos">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartServicos"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </x-body>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script>
            const propostasStatus = @json($propostasStatus);
            new Chart(document.getElementById('chartPropostas'), {
                type: 'pie',
                data: { labels: Object.keys(propostasStatus), datasets:[{ data:Object.values(propostasStatus) }] },
                options: { responsive:true }
            });

            const contratos = @json($contratos);
            new Chart(document.getElementById('chartContratos'), {
                type: 'line',
                data: {
                    labels: contratos.labels,
                    datasets: [
                        { label:'Ativos',    data: contratos.ativos, borderColor:'#22c55e', tension:.35 },
                        { label:'Encerrados',data: contratos.encerr, borderColor:'#ef4444', tension:.35 }
                    ]
                },
                options: { responsive:true }
            });

            const servicos = @json($servicos);
            new Chart(document.getElementById('chartServicos'), {
                type: 'bar',
                data: {
                    labels: servicos.map(s=>s.mes),
                    datasets: [
                        { label:'Vistoria',    data: servicos.map(s=>s.vistoria)   },
                        { label:'Instalação',  data: servicos.map(s=>s.instalacao) },
                        { label:'Pós-venda',   data: servicos.map(s=>s.pos_venda)  },
                    ]
                },
                options: { responsive:true, scales:{ x:{ stacked:true }, y:{ stacked:true } } }
            });

            // Excel
            document.getElementById('expProp').onclick = () => {
                const rows = Object.keys(propostasStatus).map(k=>({ Status:k, Quantidade:propostasStatus[k] }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Propostas');
                XLSX.writeFile(wb, 'gestao_propostas.xlsx');
            };
            document.getElementById('expContratos').onclick = () => {
                const rows = contratos.labels.map((m,i)=>({ Mês:m, Ativos:contratos.ativos[i], Encerrados:contratos.encerr[i] }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Contratos');
                XLSX.writeFile(wb, 'gestao_contratos.xlsx');
            };
            document.getElementById('expServicos').onclick = () => {
                const rows = servicos.map(s=>({ Mês:s.mes, Vistoria:s.vistoria, Instalacao:s.instalacao, PosVenda:s.pos_venda }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Servicos');
                XLSX.writeFile(wb, 'gestao_servicos.xlsx');
            };
        </script>
    @endpush
</x-layout>
