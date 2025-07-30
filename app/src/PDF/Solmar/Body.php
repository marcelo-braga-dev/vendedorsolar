<?php

namespace App\src\PDF\Solmar;

use App\src\PDF\Solmar\Sessoes\Sessao;

class Body
{
    public function execute(Sessao $sessao, DadosOrcamento $dados)
    {
        return $sessao->index($dados);
    }
}
