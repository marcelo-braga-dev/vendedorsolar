<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;

class Assinaturas implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();
        $dadosCliente = $dados->getDadosCliente();

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.assinaturas',
            compact('cliente', 'dadosCliente')));

        return $dados->mpdf;
    }
}
