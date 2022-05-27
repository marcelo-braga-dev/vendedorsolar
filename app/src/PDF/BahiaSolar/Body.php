<?php

namespace App\src\PDF\BahiaSolar;

use App\src\PDF\BahiaSolar\Sessoes\Sessao;

class Body
{
    public function execute(Sessao $sessao, DadosOrcamento $dados)
    {
        return $sessao->index($dados);
    }
}
