<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;
use App\src\PDF\Solmar\Sessoes\Sessao;

class Bancos implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $bancos = (new \App\Models\Bancos())->newQuery()
            ->where('status', 1)->get();
        $orcamento = $dados->getOrcamento();

        $dados->mpdf->WriteHTML(view('pages.pdf.solmar.sessoes.bancos',
            compact('bancos', 'orcamento')));

        return $dados->mpdf;
    }
}
