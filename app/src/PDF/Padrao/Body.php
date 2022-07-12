<?php

namespace App\src\PDF\Padrao;

use App\src\PDF\Padrao\Sessoes\Sessao;

class Body
{
    public function execute(Sessao $sessao, DadosOrcamento $dados)
    {
        return $sessao->index($dados);
    }
}
