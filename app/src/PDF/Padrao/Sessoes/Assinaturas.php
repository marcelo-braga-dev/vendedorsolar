<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\src\PDF\Padrao\DadosOrcamento;

class Assinaturas implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.assinaturas', compact('cliente')));

        return $dados->mpdf;
    }
}
