<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

class Assinaturas implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $cliente = $dados->getCliente();

        $dados->mpdf->WriteHTML(view('pages.pdf.modelo_1.sessoes.assinaturas', compact('cliente')));

        return $dados->mpdf;
    }
}
