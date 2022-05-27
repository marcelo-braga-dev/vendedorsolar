<?php

namespace App\Http\Controllers\Admin\Financeiros;

use App\Models\Orcamentos;

class FaturamentoController
{
    public function index()
    {
        $clsOrcamentos = new Orcamentos();
        $orcamentos = $clsOrcamentos->newQuery()
            ->get();

        return view('pages.admin.financeiro.faturamento.index', compact('orcamentos'));
    }
}
