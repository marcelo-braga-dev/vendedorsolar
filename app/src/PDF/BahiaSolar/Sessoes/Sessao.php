<?php

namespace App\src\PDF\BahiaSolar\Sessoes;

use App\src\PDF\BahiaSolar\DadosOrcamento;

interface Sessao
{
    public function index(DadosOrcamento $dados);
}
