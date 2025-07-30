<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;
use Mpdf\HTMLParserMode;

class Capa implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $orcamentoKit = $dados->getOrcamentoKit();
        $kit = $dados->getKit();

        $dados->mpdf->WriteHTML(view('pages.pdf.solmar.template.capa', compact('kit', 'orcamento', 'orcamentoKit')),
            HTMLParserMode::HTML_BODY);
        $dados->mpdf->AddPage('', '', '', '', '', 0, 0, 37, 15, 0, 0);//esq;dir;cima;baixo;cab;pe

        return $dados->mpdf;
    }
}
