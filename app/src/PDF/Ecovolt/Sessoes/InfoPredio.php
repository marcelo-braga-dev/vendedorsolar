<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\Models\OrcamentosMetas;
use App\src\PDF\Ecovolt\DadosOrcamento;

class InfoPredio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $orcamentoKit = $dados->getOrcamentoKit();
        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.info-predio',
            compact('orcamento', 'metas', 'orcamentoKit')));

        return $dados->mpdf;
    }

}
