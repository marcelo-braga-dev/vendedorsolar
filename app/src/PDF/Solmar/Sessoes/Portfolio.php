<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class Portfolio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.portfolio'));

        return $dados->mpdf;
    }
}
