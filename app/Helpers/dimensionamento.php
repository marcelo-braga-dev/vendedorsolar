<?php

if (!function_exists('getEstrutura')) {
    function getEstrutura($id = '')
    {
        $estrutura = (new \App\Services\EstruturasService())->get_estrutura($id);
        if (!empty($estrutura->nome)) return $estrutura->nome;
        return 'Inválido';
    }
}

if (!function_exists('getEstruturas')) {
    function getEstruturas()
    {
        return (new \App\Services\EstruturasService())->get_estruturas();
    }
}

if (!function_exists('getIrradiacao')) {
    function getIrradiacao($id)
    {
        $valor = (new \App\Models\IrradiacaoSolar())->newQuery()
            ->where('cidades_estados_id', '=', $id)
            ->first();
        return $valor->media ?? 0;
    }
}

if (!function_exists('getDirecaoInstalacao')) {
    function getDirecaoInstalacao($direcao)
    {
        // 'sudeste_noroeste' é uma chave legada (substituída por 'nordeste_noroeste' e
        // 'sudeste_sudoeste'), mantida aqui só para exibir corretamente propostas já emitidas.
        $legado = ['sudeste_noroeste' => 'Sudeste/Noroeste'];
        $todosStatus = (new \App\src\Orcamentos\DirecaoInstalacao())->direcoes() + $legado;
        return $todosStatus[$direcao] ?? 'Não encontrado';
    }
}
