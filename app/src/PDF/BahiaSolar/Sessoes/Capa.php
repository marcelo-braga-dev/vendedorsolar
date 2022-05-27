<?php

namespace App\src\PDF\BahiaSolar\Sessoes;

use App\src\PDF\BahiaSolar\DadosOrcamento;
use Mpdf\HTMLParserMode;

class Capa implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.template.capa', compact('kit', 'orcamento')),
            HTMLParserMode::HTML_BODY);

        $dados->mpdf->AddPage('', '', '', '', '', 0, 0, 37, 25, 0, 0);//esq;dir;cima;baixo;cab;pe

        return $dados->mpdf;
    }
}
