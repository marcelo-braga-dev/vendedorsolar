<?php

namespace App\src\PDF\Ecovolt\Servicos;

use App\src\PDF\Solmar\DadosOrcamento;
use App\src\PDF\Solmar\Sessoes\Sessao;

class Conteudo
{
    public function index($dados, $proposta)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.servicos.conteudo',
            compact('proposta')));

        return $dados->mpdf;
    }
}
