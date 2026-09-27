<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\src\PDF\CasaVerde\DadosOrcamento;

interface Sessao
{
    public function index(DadosOrcamento $dados);
}
