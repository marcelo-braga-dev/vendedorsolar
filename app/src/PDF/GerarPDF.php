<?php

namespace App\src\PDF;

use App\src\PDF\Solmar\Construtor;

class GerarPDF
{
    public function gerar($dados)
    {
        $gerar = (new Construtor($dados->id, $dados->grafico_geracao, $dados->grafico_payback));
        return $gerar->gerar();
    }
}
