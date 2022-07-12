<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\Models\Produtos;
use App\src\PDF\Padrao\DadosOrcamento;

class Imagenskit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();

        $produtos = new Produtos();
        $imagens = $produtos->getImagensNome();

        $orcamento = $dados->getOrcamento();

        $idProdutoTrafo = (new Produtos())->newQuery()
            ->where('tipo', '=', 'trafo')
            ->first(['id']);

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.imagens-kit',
            compact('imagens', 'kit', 'orcamento', 'idProdutoTrafo')));

        return $dados->mpdf;
    }
}
