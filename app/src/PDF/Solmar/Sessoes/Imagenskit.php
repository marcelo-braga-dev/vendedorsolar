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

        $produtos = new Produtos();
        $imagens = $produtos->getImagensNome();

        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.imagens-kit',
            compact('imagens', 'kit')));

        return $dados->mpdf;
    }
}
