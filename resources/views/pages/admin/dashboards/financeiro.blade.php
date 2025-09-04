<x-layout menu="dashboards" submenu="dashboards-financeiro">
    <x-body title="Dashboard Financeiro" class="p-4">
        {{-- Cards resumo --}}
        @php
            $totalReceita = array_sum($series['receita']);
            $totalCustos  = array_sum($series['custos']);
            $lucro        = $totalReceita - $totalCustos;
        @endphp

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <small class="text-muted">Receita no Ano</small>
                        <h3 class="mb-0 text-success">R$ {{ number_format($totalReceita,2,',','.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <small class="text-muted">Custos no Ano</small>
                        <h3 class="mb-0 text-danger">R$ {{ number_format($totalCustos,2,',','.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <small class="text-muted">Lucro Estimado</small>
                        <h3 class="mb-0">{{ $lucro >= 0 ? '🟢' : '🔴' }} R$ {{ number_format($lucro,2,',','.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gráficos + export --}}
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Receita x Custos (Mensal)</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="btnExcel1">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartReceitaCustos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Comissões (Mensal)</h6>
                        <button class="btn btn-sm btn-outline-secondary" id="btnExcel2">Exportar Excel</button>
                    </div>
                    <div class="card-body">
                        <canvas id="chartComissoes"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </x-body>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script>
            const labels = @json($series['labels']);
            const receita = @json($series['receita']);
            const custos  = @json($series['custos']);
            const comissao= @json($series['comissao']);

            // Receita x Custos
            new Chart(document.getElementById('chartReceitaCustos'), {
                type: 'line',
                data: {
                    labels,
                    datasets: [
                        { label: 'Receita', data: receita, tension: .35, borderWidth: 2, borderColor: '#16a34a', pointRadius: 3, fill: false },
                        { label: 'Custos',  data: custos,  tension: .35, borderWidth: 2, borderColor: '#ef4444', pointRadius: 3, fill: false }
                    ]
                },
                options: { responsive: true, scales: { y: { ticks:{ callback:v=>'R$ '+v.toLocaleString('pt-BR') }}}}
            });

            // Comissões
            new Chart(document.getElementById('chartComissoes'), {
                type: 'bar',
                data: { labels, datasets: [{ label:'Comissões', data: comissao, backgroundColor: '#2563eb' }] },
                options: { responsive:true, plugins:{ legend:{display:false} }, scales:{ y:{ ticks:{ callback:v=>'R$ '+v.toLocaleString('pt-BR')}}}}
            });

            // Exportações Excel
            document.getElementById('btnExcel1').onclick = () => {
                const rows = labels.map((m, i)=>({ Mês:m, Receita:receita[i], Custos:custos[i] }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Receita_Custos');
                XLSX.writeFile(wb, 'financeiro_receita_custos.xlsx');
            };
            document.getElementById('btnExcel2').onclick = () => {
                const rows = labels.map((m, i)=>({ Mês:m, Comissao:comissao[i] }));
                const ws = XLSX.utils.json_to_sheet(rows);
                const wb = XLSX.utils.book_new(); XLSX.utils.book_append_sheet(wb, ws, 'Comissoes');
                XLSX.writeFile(wb, 'financeiro_comissoes.xlsx');
            };
        </script>
    @endpush
</x-layout>
