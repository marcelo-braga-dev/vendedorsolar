<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\Models\OrcamentosMetas;
use App\src\PDF\CasaVerde\DadosOrcamento;

class InfoPredio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $orcamentoKit = $dados->getOrcamentoKit();
        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.info-predio',
            compact('orcamento', 'orcamentoKit', 'metas')));

        return $dados->mpdf;
    }

}
