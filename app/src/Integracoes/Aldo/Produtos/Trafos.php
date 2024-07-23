<?php

namespace App\src\Integracoes\Aldo\Produtos;

use Illuminate\Database\QueryException;

class Trafos
{
    private $indices;

    public function __construct(\SimpleXMLElement $produto, $indices)
    {
        $this->indices = $indices;
    }

    public function atualizar($dados, $skus)
    {
        print_pre(strip_tags($dados->codigo));
    }

    public function cadastrar($dados)
    {
        $trafos = (new \App\Models\Trafos());
        $atualizado = $trafos->
        atualizarPrecoPeloSKU(strip_tags($dados->codigo), convert_money_float(strip_tags($dados->preco)));

        if (!$atualizado) {
            try {
                $marca = strip_tags($dados->marca);
                $trafos->newQuery();
                $trafos->sku = strip_tags($dados->codigo);
                $trafos->modelo = strip_tags($dados->descricao);
                $trafos->produtos_id = $this->indices['trafo'][$marca]['id_referencia'];
                $trafos->potencia = 0;
                $trafos->preco_cliente = 0;
                $trafos->preco_fornecedor = convert_money_float(strip_tags($dados->preco));
                $trafos->fornecedor = 1;
                $trafos->push();
            } catch (QueryException $exception) {
                throw new \DomainException('Falha no cadastro de trafos ' . $marca);
            }
        }
    }
}
