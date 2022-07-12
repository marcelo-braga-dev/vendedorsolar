<?php

namespace App\src\PDF\Padrao\Sessoes;

use App\src\PDF\Padrao\DadosOrcamento;

interface Sessao
{
    public function index(DadosOrcamento $dados);
}
