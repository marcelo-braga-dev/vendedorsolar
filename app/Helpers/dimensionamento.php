<?php

use App\Models\DadosDimensionamento;

if (!function_exists('getDadoDimenOrientacao')) {
    function getDadoDimenOrientacao(string $key) {
        $dado = new DadosDimensionamento();
        return $dado->newQuery()
            ->where('meta', '=', 'orientacao_intalacao')
            ->where('meta_key', '=', $key)
            ->first()
            ->value ?? '';
    }
}
