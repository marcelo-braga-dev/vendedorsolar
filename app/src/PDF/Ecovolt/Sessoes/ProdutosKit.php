<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\Models\Produtos;
use App\src\PDF\Ecovolt\DadosOrcamento;

class ProdutosKit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $imagens = (new Produtos())->getDados();
        $orcamentoKit = $dados->getOrcamentoKit();

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.produtos-kit',
            compact('imagens', 'kit', 'orcamentoKit')));

        return $dados->mpdf;
    }
}
