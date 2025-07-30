<?php

namespace App\src\PDF\Solmar\Sessoes;

use App\src\PDF\Solmar\DadosOrcamento;

interface Sessao
{
    public function index(DadosOrcamento $dados);
}
