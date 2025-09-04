<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\src\PDF\Ecovolt\DadosOrcamento;

class Graficos implements Sessao
{
    private string $graficoGeracao;
    private string $graficoPayback;

    public function __construct(string $graficoGeracao, string $graficoPayback)
    {
        $this->graficoGeracao = $graficoGeracao;
        $this->graficoPayback = $graficoPayback;
    }

    public function index(DadosOrcamento $dados)
    {
        $graficoGeracao = $this->graficoGeracao;
        $graficoPayback = $this->graficoPayback;

        $dados->mpdf->WriteHTML(view('pages.pdf.ecovolt.sessoes.graficos',
            compact('graficoGeracao', 'graficoPayback')));

        return $dados->mpdf;
    }
}
