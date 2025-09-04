<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\src\PDF\Ecovolt\DadosOrcamento;

class Bancos implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $bancos = (new \App\Models\Bancos())->newQuery()->get();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.bancos',
            compact('bancos', 'orcamento')));

        return $dados->mpdf;
    }
}
