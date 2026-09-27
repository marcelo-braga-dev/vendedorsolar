<?php

namespace App\src\PDF\CasaVerde;

use App\src\PDF\CasaVerde\Sessoes\Sessao;

class Body
{
    public function execute(Sessao $sessao, DadosOrcamento $dados)
    {
        return $sessao->index($dados);
    }
}
