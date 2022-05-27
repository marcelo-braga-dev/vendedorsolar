<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class Beneficios implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.beneficios'));

        return $dados->mpdf;
    }
}
