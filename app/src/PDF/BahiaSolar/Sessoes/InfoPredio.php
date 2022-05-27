<?php

namespace App\src\PDF\BahiaSolar\Sessoes;

use App\Models\OrcamentosMetas;
use App\src\PDF\BahiaSolar\DadosOrcamento;

class InfoPredio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.info-predio',
            compact('orcamento', 'metas')));

        return $dados->mpdf;
    }

}
