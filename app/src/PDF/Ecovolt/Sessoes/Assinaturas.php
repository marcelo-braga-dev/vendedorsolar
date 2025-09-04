<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\src\PDF\Ecovolt\DadosOrcamento;

class Assinaturas implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $orcamento = $dados->getOrcamento();
        $clienteDados = $dados->getClienteDados();

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.assinaturas', compact('orcamento', 'clienteDados')));

        return $dados->mpdf;
    }
}
