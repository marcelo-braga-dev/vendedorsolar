<?php

namespace App\src\Orcamentos;

use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\src\Orcamentos\Status\Status;

class Orcamento
{
    public function cadastrar(CadastrarOrcamentoRequest $request): int
    {
        $orcamento = new CadastrarOrcamento(new DadosOrcamento($request));

        return $orcamento->cadastrar();
    }

    public function alterarStatus(int $id, Status $status)
    {
        $status->alterarStatus($id);
    }
}
