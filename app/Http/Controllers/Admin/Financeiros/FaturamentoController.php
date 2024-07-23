<?php

namespace App\Http\Controllers\Admin\Financeiros;

use App\Http\Controllers\Controller;
use App\Models\Orcamentos;

class FaturamentoController extends Controller
{
    public function index()
    {
        $clsOrcamentos = new Orcamentos();
        $orcamentos = $clsOrcamentos->newQuery()
            ->get();

        return view('pages.admin.financeiro.faturamento.index', compact('orcamentos'));
    }
}
