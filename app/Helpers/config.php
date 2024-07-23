<?php

if (!function_exists('implementadoContratos')) {
    function implementadoContratos()
    {
        $valor = (new \App\Models\Configs())->newQuery()
            ->where('meta_key', 'implementado_contratos')->first();

        if ($valor) if ($valor->value) return true;
        return false;
    }
}
