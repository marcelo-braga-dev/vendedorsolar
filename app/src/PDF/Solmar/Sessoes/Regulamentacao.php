<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class Regulamentacao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.regulamentacao'));

        return $dados->mpdf;
    }
}
