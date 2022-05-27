<?php

namespace App\src\PDF\BahiaSolar\Sessoes;

use App\src\PDF\BahiaSolar\DadosOrcamento;

class Introducao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();
        $vendedor = $dados->getVendedor();
        $orcamento = $dados->getOrcamento();
        $dadosCliente = $dados->getDadosCliente();

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.introducao',
            compact('cliente', 'vendedor', 'orcamento', 'dadosCliente')));

        return $dados->mpdf;
    }
}
