<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contratos;
use App\Models\Leads;
use App\Models\Orcamentos;
use App\Models\OrcamentosKits;
use App\Models\VisitasTecnicas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function financeiro()
    {
        $ano = now()->year;
        $meses = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];

        $receita = array_fill(0, 12, 0.0);
        $custos  = array_fill(0, 12, 0.0);
        $comissao = array_fill(0, 12, 0.0);

        // Receita: soma do preco_cliente dos orçamentos finalizados no ano
        $receitaRows = DB::table('orcamentos')
            ->selectRaw('MONTH(created_at) as mes, SUM(preco_cliente) as total')
            ->where('status', 'finalizado')
            ->whereYear('created_at', $ano)
            ->groupBy('mes')
            ->get();

        foreach ($receitaRows as $row) {
            $receita[$row->mes - 1] = (float) $row->total;
        }

        // Custos: soma do preco_fornecedor via orcamentos_kits (join com orcamentos finalizados)
        $custosRows = DB::table('orcamentos_kits')
            ->join('orcamentos', 'orcamentos.id', '=', 'orcamentos_kits.orcamentos_id')
            ->selectRaw('MONTH(orcamentos.created_at) as mes, SUM(orcamentos_kits.preco_fornecedor) as total')
            ->where('orcamentos.status', 'finalizado')
            ->whereYear('orcamentos.created_at', $ano)
            ->groupBy('mes')
            ->get();

        foreach ($custosRows as $row) {
            $custos[$row->mes - 1] = (float) $row->total;
        }

        // Comissão: preco_cliente * taxa_comissao / 100 dos orçamentos finalizados
        $comissaoRows = DB::table('orcamentos_kits')
            ->join('orcamentos', 'orcamentos.id', '=', 'orcamentos_kits.orcamentos_id')
            ->selectRaw('MONTH(orcamentos.created_at) as mes, SUM(orcamentos_kits.preco_cliente * orcamentos_kits.taxa_comissao / 100) as total')
            ->where('orcamentos.status', 'finalizado')
            ->whereYear('orcamentos.created_at', $ano)
            ->groupBy('mes')
            ->get();

        foreach ($comissaoRows as $row) {
            $comissao[$row->mes - 1] = (float) $row->total;
        }

        $series = [
            'labels'   => $meses,
            'receita'  => $receita,
            'custos'   => $custos,
            'comissao' => $comissao,
        ];

        return view('pages.admin.dashboards.financeiro', compact('series'));
    }

    public function vendas()
    {
        // Ranking de vendedores por valor total de orçamentos finalizados
        $rankingRows = DB::table('orcamentos')
            ->join('users', 'users.id', '=', 'orcamentos.users_id')
            ->selectRaw('users.name as vendedor, COUNT(orcamentos.id) as vendas, SUM(orcamentos.preco_cliente) as valor')
            ->where('orcamentos.status', 'finalizado')
            ->whereIn('users.tipo', ['vendedor', 'admin_vendedor'])
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('valor')
            ->limit(10)
            ->get();

        $ranking = $rankingRows->map(fn($r) => [
            'vendedor' => $r->vendedor,
            'vendas'   => (int) $r->vendas,
            'valor'    => (float) $r->valor,
        ])->toArray();

        // Funil: quantidade de orçamentos por status (pipeline)
        $funilLabels = [
            'novo'                => 'Novos',
            'aprovando'           => 'Para Aprovação',
            'aprovado'            => 'Aprovados',
            'aprovacao_reprovada' => 'Reprovados',
            'instalando'          => 'Em Instalação',
            'finalizado'          => 'Finalizados',
        ];

        $funilRows = DB::table('orcamentos')
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $funil = [];
        foreach ($funilLabels as $key => $label) {
            $funil[$label] = isset($funilRows[$key]) ? (int) $funilRows[$key]->total : 0;
        }

        // Origens dos leads
        $origensRows = DB::table('leads')
            ->selectRaw('origem, COUNT(*) as total')
            ->whereNotNull('origem')
            ->where('origem', '!=', '')
            ->groupBy('origem')
            ->orderByDesc('total')
            ->get();

        $origens = [];
        foreach ($origensRows as $row) {
            $origens[$row->origem] = (int) $row->total;
        }

        if (empty($origens)) {
            $origens = ['Sem origem cadastrada' => 0];
        }

        return view('pages.admin.dashboards.vendas', compact('ranking', 'funil', 'origens'));
    }

    public function gestao()
    {
        $ano = now()->year;
        $meses = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];

        // Propostas por status (total geral)
        $statusLabels = [
            'novo'                => 'Novos',
            'aprovando'           => 'Para Aprovação',
            'aprovado'            => 'Aprovados',
            'aprovacao_reprovada' => 'Reprovados',
            'instalando'          => 'Em Instalação',
            'finalizado'          => 'Finalizados',
        ];

        $statusRows = DB::table('orcamentos')
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $propostasStatus = [];
        foreach ($statusLabels as $key => $label) {
            $count = isset($statusRows[$key]) ? (int) $statusRows[$key]->total : 0;
            if ($count > 0) {
                $propostasStatus[$label] = $count;
            }
        }

        if (empty($propostasStatus)) {
            $propostasStatus = ['Sem dados' => 0];
        }

        // Contratos: ativos (instalando) x encerrados (finalizado) por mês
        $ativos = array_fill(0, 12, 0);
        $encerr = array_fill(0, 12, 0);

        $ativosRows = DB::table('orcamentos')
            ->selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->where('status', 'instalando')
            ->whereYear('created_at', $ano)
            ->groupBy('mes')
            ->get();

        foreach ($ativosRows as $row) {
            $ativos[$row->mes - 1] = (int) $row->total;
        }

        $encerrRows = DB::table('orcamentos')
            ->selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->where('status', 'finalizado')
            ->whereYear('created_at', $ano)
            ->groupBy('mes')
            ->get();

        foreach ($encerrRows as $row) {
            $encerr[$row->mes - 1] = (int) $row->total;
        }

        $contratos = [
            'labels' => $meses,
            'ativos' => $ativos,
            'encerr' => $encerr,
        ];

        // Serviços: visitas técnicas + instalações + finalizados por mês (últimos 6 meses)
        $ultimosMeses = collect(range(5, 0))->map(function ($i) {
            return now()->subMonths($i);
        });

        $vistoriaRows = DB::table('visitas_tecnicas')
            ->selectRaw('MONTH(created_at) as mes, YEAR(created_at) as ano, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy('ano', 'mes')
            ->get()
            ->keyBy(fn($r) => "{$r->ano}-{$r->mes}");

        $instalacaoRows = DB::table('orcamentos')
            ->selectRaw('MONTH(created_at) as mes, YEAR(created_at) as ano, COUNT(*) as total')
            ->where('status', 'instalando')
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy('ano', 'mes')
            ->get()
            ->keyBy(fn($r) => "{$r->ano}-{$r->mes}");

        $posVendaRows = DB::table('orcamentos')
            ->selectRaw('MONTH(created_at) as mes, YEAR(created_at) as ano, COUNT(*) as total')
            ->where('status', 'finalizado')
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy('ano', 'mes')
            ->get()
            ->keyBy(fn($r) => "{$r->ano}-{$r->mes}");

        $servicos = $ultimosMeses->map(function ($date) use ($vistoriaRows, $instalacaoRows, $posVendaRows) {
            $key = "{$date->year}-{$date->month}";
            return [
                'mes'        => $date->locale('pt_BR')->isoFormat('MMM'),
                'vistoria'   => isset($vistoriaRows[$key])   ? (int) $vistoriaRows[$key]->total   : 0,
                'instalacao' => isset($instalacaoRows[$key]) ? (int) $instalacaoRows[$key]->total : 0,
                'pos_venda'  => isset($posVendaRows[$key])   ? (int) $posVendaRows[$key]->total   : 0,
            ];
        })->values()->toArray();

        return view('pages.admin.dashboards.gestao', compact('propostasStatus', 'contratos', 'servicos'));
    }
}
