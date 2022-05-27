<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\Produtos;

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

        $res = [
            'cliente' => get_nome_cliente($orcamento->clientes_id),
            'orcamento' => $orcamento,
            'kit' => $kit
        ];

        $produtos = new Produtos();
        $imagens = $produtos->getImagensNome();

        return view('pages.pdf.modelo_1.pagina_1',
            compact('orcamento', 'kit', 'imagens'));
    }
}
