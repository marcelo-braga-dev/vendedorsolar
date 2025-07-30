<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\Models\Kits;
use App\Models\Produtos;
use App\src\PDF\Solmar\DadosOrcamento;

class Imagenskit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $imagens = (new Produtos())->getDados();
        $orcamentoKit = $dados->getOrcamentoKit();
        $trafo = $dados->getTrafo();

        $dados->mpdf->WriteHTML(view('pages.pdf.solmar.sessoes.imagens-kit',
            compact('imagens', 'kit', 'orcamentoKit', 'trafo')));

        return $dados->mpdf;
    }
}
