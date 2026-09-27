<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;
use Mpdf\HTMLParserMode;

class Capa implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $orcamentoKit = $dados->getOrcamentoKit();
        $kit = $dados->getKit();

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.template.capa', compact('kit', 'orcamento', 'orcamentoKit')),
            HTMLParserMode::HTML_BODY);

        return $dados->mpdf;
    }
}
