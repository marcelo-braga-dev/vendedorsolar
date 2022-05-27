<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class Introducao implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();
        $vendedor = $dados->getVendedor();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.introducao',
            compact('cliente', 'vendedor', 'orcamento')));

        return $dados->mpdf;
    }
}
