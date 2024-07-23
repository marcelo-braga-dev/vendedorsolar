<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kits;
use App\Models\OrcamentosKits;
use App\Models\Orcamentos;
use App\Models\OrcamentosMetas;
use App\Models\Produtos;
use App\Models\Trafos;

class OrcamentoApiController extends Controller
{
    public function show($token)
    {
        $orcamento = (new Orcamentos())->newQuery()
            ->where('token', '=', $token)
            ->firstOrFail();

        $orcamentoKitId = (new OrcamentosKits())->getIdKit($orcamento->id);
        $kit = (new Kits())->newQuery()->findOrFail($orcamentoKitId);
        $trafo = (new Trafos())->newQuery()->find($orcamento->trafo);
        $imagens = (new Produtos())->getDados();
        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        return view('pages.vendedor.orcamentos.externa.index',
            compact('orcamento', 'kit', 'trafo', 'imagens', 'metas'));
    }
}
