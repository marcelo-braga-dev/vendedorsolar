<?php

namespace App\src\PDF\Ecovolt\Sessoes;

use App\src\PDF\Ecovolt\DadosOrcamento;

interface Sessao
{
    public function index(DadosOrcamento $dados);
}
