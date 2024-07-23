<?php

use App\src\Produtos\CalculoPrecos\MargensPadrao;

if (!function_exists('calculaPrecoPrincipalKit')) {
    function calculaPrecoPrincipalKit($id)
    {
        $dados = (new \App\Models\Kits())->newQuery()->findOrFail($id);
        $margem = (new MargensPadrao($dados->potencia_kit))->getMargem();

        return $dados->preco_fornecedor * (1 + ($margem/100));
    }
}

if (!function_exists('getMargemPrincipal')) {
    function getMargemPrincipal($id)
    {
        $dados = (new \App\Models\Kits())->newQuery()->findOrFail($id);
        return (new MargensPadrao($dados->potencia_kit))->getMargem();
    }
}
