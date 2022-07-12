<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\src\PDF\Padrao\DadosOrcamento;

class Beneficios implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.beneficios'));

        return $dados->mpdf;
    }
}
