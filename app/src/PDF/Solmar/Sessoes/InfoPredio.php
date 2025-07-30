<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\Models\OrcamentosMetas;
use App\src\PDF\Solmar\DadosOrcamento;

class InfoPredio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $orcamentoKit = $dados->getOrcamentoKit();
        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        $dados->mpdf->WriteHTML(view('pages.pdf.solmar.sessoes.info-predio',
            compact('orcamento', 'orcamentoKit', 'metas')));

        return $dados->mpdf;
    }

}
