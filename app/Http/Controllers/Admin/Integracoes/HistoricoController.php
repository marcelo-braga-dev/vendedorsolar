<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Models\IntegracaoHistorico;

class HistoricoController extends Controller
{
    public function index()
    {
        $historicos = (new IntegracaoHistorico())->newQuery()
            ->orderBy('id', 'DESC')->paginate();

        return view('pages.admin.integracoes.historico.index', compact('historicos'));
    }
}
