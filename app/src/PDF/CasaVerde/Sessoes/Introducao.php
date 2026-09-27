<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;

class Introducao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $cliente = $dados->getCliente();
        $vendedor = $dados->getVendedor();
        $kit = $dados->getKit();
        $orcamentoKit = $dados->getOrcamentoKit();

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.introducao',
            compact('orcamento', 'cliente', 'vendedor', 'kit', 'orcamentoKit')));

        return $dados->mpdf;
    }
}
