<?php

namespace App\src\Produtos\CalculoPrecos;

class CalcularPrecoVenda
{
    public function calcular(Margens $margens): array
    {
        return $margens->calcular();
    }
}
