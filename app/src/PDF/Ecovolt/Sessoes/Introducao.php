<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\src\PDF\Ecovolt\DadosOrcamento;

class Introducao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();
        $vendedor = $dados->getVendedor();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.introducao',
            compact('cliente', 'vendedor', 'orcamento')));

        return $dados->mpdf;
    }
}
