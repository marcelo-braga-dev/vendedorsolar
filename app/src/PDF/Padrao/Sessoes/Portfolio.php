<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\src\PDF\Padrao\DadosOrcamento;

class Portfolio implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.portfolio'));
        $dados->mpdf->WriteHTML(view('pages.pdf.bahia-solar.sessoes.lista-marcas-equipamentos'));

        return $dados->mpdf;
    }
}
