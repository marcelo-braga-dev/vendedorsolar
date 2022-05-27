<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\OrcamentosMetas;
use App\Models\Produtos;
use App\Models\Trafos;

class OrcamentoApiController extends Controller
{
    public function show($token)
    {
        $orcamento = new Orcamentos();

        $orcamento = $orcamento->newQuery()
            ->where('token', '=', $token)
            ->firstOrFail();

        $kits = new Kits();
        $kit = $kits->newQuery()->findOrFail($orcamento->kits_id);

        $trafos = new Trafos();
        $trafo = $trafos->newQuery()->find($orcamento->trafo);

        $produtos = new Produtos();
        $imagens = $produtos->getImagensNome();

        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        return view('pages.pdf.modelo_1.pagina_1',
            compact('orcamento', 'kit', 'trafo', 'imagens', 'metas'));
    }
}
