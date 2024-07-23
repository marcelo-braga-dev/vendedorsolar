<?php

namespace App\src\Produtos\CalculoPrecos;

class CalcularPrecoVenda
{
    public function calcular(Margens $margens): float
    {
        return $margens->calcular();
    }
}
