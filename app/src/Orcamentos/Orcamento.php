<?php

namespace App\src\Orcamentos;

use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\src\Orcamentos\Status\Status;

class Orcamento
{
    public function cadastrar(CadastrarOrcamentoRequest $request): int
    {
        $recalculo = new RecalculaPrecoOrcamento($request);

        $dados = new DadosOrcamento($request);
        $dados->preco = $recalculo->getPrecoCliente();
        $dados->geracao = $recalculo->getGeracao();

        $orcamento = new CadastrarOrcamento($dados);

        return $orcamento->cadastrar();
    }

    public function alterarStatus(int $id, Status $status)
    {
        $status->alterarStatus($id);
    }
}
