<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

use App\Models\Trafos;

abstract class SelecionaTrafoDB
{
    protected function getTrafo($item)
    {
        $potencia = $item->potencia_kit * 1.1;

        $trafo = (new Trafos())->newQuery()
            ->where('potencia', '>', $potencia)
            ->where('status', '1')
            ->orderBy('potencia', 'ASC')
            ->first(['id', 'modelo', 'preco_cliente', 'potencia']);
        //print_pre($trafo->toArray());
        if($trafo !== null) {
            $item->trafo = $trafo->id;
            $item->nome_trafo = $trafo->modelo;
            $item->preco_trafo = $trafo->preco_cliente;
            $item->preco_cliente += $trafo->preco_cliente;
        }
    }
}
