<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\src\PDF\Padrao\DadosOrcamento;

class Regulamentacao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.regulamentacao'));

        return $dados->mpdf;
    }
}
