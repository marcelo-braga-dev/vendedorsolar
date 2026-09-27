<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;

class InfoKit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $orcamento = $dados->getOrcamento();
        $orcamentoKit = $dados->getOrcamentoKit();

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.info-kit',
            compact('kit', 'orcamento', 'orcamentoKit')));

        return $dados->mpdf;
    }
}
