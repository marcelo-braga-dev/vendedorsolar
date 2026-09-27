<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;
use App\src\PDF\CasaVerde\Sessoes\Sessao;

class Bancos implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $bancos = (new \App\Models\Bancos())->newQuery()
            ->where('status', 1)->get();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.bancos',
            compact('bancos', 'orcamento')));

        return $dados->mpdf;
    }
}
