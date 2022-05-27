<?php

namespace App\src\Orcamentos;

use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\UserMeta;

class Orcamento
{
    public function cadastrar(CadastrarOrcamentoRequest $request): int
    {
        $dados = new DadosOrcamento($request);

        $orcamento = new CadastrarOrcamento($dados);

        return $orcamento->cadastrar();
    }
}
