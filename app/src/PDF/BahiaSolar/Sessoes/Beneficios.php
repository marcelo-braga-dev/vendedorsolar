<?php

namespace App\src\PDF\BahiaSolar\Sessoes;

use App\src\PDF\BahiaSolar\DadosOrcamento;

class Beneficios implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.beneficios'));

        return $dados->mpdf;
    }
}
