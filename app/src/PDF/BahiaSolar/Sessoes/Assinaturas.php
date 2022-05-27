<?php

namespace App\src\PDF\BahiaSolar\Sessoes;

use App\src\PDF\BahiaSolar\DadosOrcamento;

class Assinaturas implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();

        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.assinaturas', compact('cliente')));

        return $dados->mpdf;
    }
}
