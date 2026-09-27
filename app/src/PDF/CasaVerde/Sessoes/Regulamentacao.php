<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;

class Regulamentacao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.regulamentacao'));

        return $dados->mpdf;
    }
}
