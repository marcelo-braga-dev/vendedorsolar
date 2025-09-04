<?php

namespace App\src\PDF\Ecovolt;

use App\src\PDF\Ecovolt\Sessoes\Sessao;

class Body
{
    public function execute(Sessao $sessao, DadosOrcamento $dados)
    {
        return $sessao->index($dados);
    }
}
