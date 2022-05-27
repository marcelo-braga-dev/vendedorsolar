<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class InfoKit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.info-kit',
            compact('kit', 'orcamento')));

        return $dados->mpdf;
    }
}
