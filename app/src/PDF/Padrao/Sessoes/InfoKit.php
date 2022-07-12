<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\Models\Trafos;
use App\src\PDF\Padrao\DadosOrcamento;

class InfoKit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $orcamento = $dados->getOrcamento();
        $trafo = (new Trafos())->newQuery()->find($orcamento->trafo);

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.info-kit',
            compact('kit', 'orcamento', 'trafo')));

        return $dados->mpdf;
    }
}
