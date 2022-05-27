<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class InfoPredio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.info-predio', compact('orcamento')));

        return $dados->mpdf;
    }

}
