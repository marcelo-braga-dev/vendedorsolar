<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\Models\Kits;
use App\Models\Produtos;
use App\src\PDF\Ecovolt\DadosOrcamento;

class Imagenskit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $imagens = (new Produtos())->getDados();
        $orcamentoKit = $dados->getOrcamentoKit();

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.imagens-kit',
            compact('imagens', 'kit', 'orcamentoKit')));

        return $dados->mpdf;
    }
}
