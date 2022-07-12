<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\src\PDF\Padrao\DadosOrcamento;
use Mpdf\HTMLParserMode;

class Capa implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.padrao.template.capa', compact('kit', 'orcamento')),
            HTMLParserMode::HTML_BODY);

        $dados->mpdf->AddPage('', '', '', '', '', 0, 0, 37, 25, 0, 0);//esq;dir;cima;baixo;cab;pe

        return $dados->mpdf;
    }
}
