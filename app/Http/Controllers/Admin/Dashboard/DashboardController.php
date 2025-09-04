<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function financeiro()
    {
        // Exemplo de dados (substitua por queries reais)
        $series = [
            'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            'receita' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'custos' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'comissao' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];
        return view('pages.admin.dashboards.financeiro', compact('series'));
    }

    public function vendas()
    {
        $ranking = [
            ['vendedor' => 'A', 'vendas' => 0, 'valor' => 0],
            ['vendedor' => 'B', 'vendas' => 0, 'valor' => 0],
            ['vendedor' => 'C', 'vendas' => 0, 'valor' => 0],
            ['vendedor' => 'D', 'vendas' => 0, 'valor' => 0],
            ['vendedor' => 'E', 'vendas' => 0, 'valor' => 0],
        ];
        $funil = ['Leads' => 0, 'Qualificados' => 0, 'Propostas' => 0, 'Negociações' => 0, 'Fechados' => 0];
        $origens = ['Orgânico' => 0, 'Indicação' => 0, 'Anúncios' => 0, 'Eventos' => 0, 'Parcerias' => 0];

        return view('pages.admin.dashboards.vendas', compact('ranking', 'funil', 'origens'));
    }

    public function gestao()
    {
        $propostasStatus = ['Aprovadas' => 1, 'Em análise' => 0, 'Recusadas' => 0, 'Vencidas' => 0];
        $contratos = [
            'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            'ativos' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'encerr' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];
        $servicos = [
            ['mes' => 'Jan', 'vistoria' => 0, 'instalacao' => 0, 'pos_venda' => 0],
            ['mes' => 'Fev', 'vistoria' => 0, 'instalacao' => 0, 'pos_venda' => 0],
            ['mes' => 'Mar', 'vistoria' => 0, 'instalacao' => 0, 'pos_venda' => 0],
            ['mes' => 'Abr', 'vistoria' => 0, 'instalacao' => 0, 'pos_venda' => 0],
            ['mes' => 'Mai', 'vistoria' => 0, 'instalacao' => 0, 'pos_venda' => 0],
            ['mes' => 'Jun', 'vistoria' => 0, 'instalacao' => 0, 'pos_venda' => 0],
        ];
        return view('pages.admin.dashboards.gestao', compact('propostasStatus', 'contratos', 'servicos'));
    }
}
