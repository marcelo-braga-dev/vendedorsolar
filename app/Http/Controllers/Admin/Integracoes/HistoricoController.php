<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\IntegracaoHistorico;

class HistoricoController extends Controller
{
    public function index()
    {
        $historicos = (new IntegracaoHistorico())->newQuery()
            ->orderBy('id', 'DESC')->paginate();
        $fornecedores = (new Fornecedores())->fornecedores();
        $origens = (new OrigensIntegracoes())->getNomes();

        return view('pages.admin.integracoes.historico.index',
            compact('historicos', 'fornecedores', 'origens'));
    }
}
