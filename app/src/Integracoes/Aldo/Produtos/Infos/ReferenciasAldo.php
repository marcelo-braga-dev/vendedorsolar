<?php

namespace App\src\Integracoes\Aldo\Produtos\Infos;

use App\Models\IntegracaoAldo;

class ReferenciasAldo
{
    public function get(): array
    {
        $dados = [];

        $indices = IntegracaoAldo::get();

        foreach ($indices as $item) {
            $dados[$item->categoria][$item->aldo] = $item->toArray();
        }

        return $dados;
    }

    public function update($dados)
    {
        $integracao = new IntegracaoAldo();

        foreach ($dados->paineis as $index => $painel) {
            $integracao->updateOrInsert(
                ['categoria' => 'painel', 'aldo' => $index],
                ['id_referencia' => $painel, 'potencia' => $dados->potencia_paineis[$index]]
            );
        }

        foreach ($dados->inversores as $index => $inversor) {
            $integracao->updateOrInsert(
                ['categoria' => 'inversor', 'aldo' => $index],
                ['id_referencia' => $inversor]
            );
        }

        foreach ($dados->estruturas as $index => $estrutura) {
            $integracao->updateOrInsert(
                ['categoria' => 'estrutura', 'aldo' => $index],
                ['id_referencia' => $estrutura]
            );
        }
    }
}
