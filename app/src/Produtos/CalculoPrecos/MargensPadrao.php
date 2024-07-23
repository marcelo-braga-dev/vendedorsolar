<?php

namespace App\src\Produtos\CalculoPrecos;

use App\Models\PrecificacaoPrincipal;

class MargensPadrao implements Margens
{
    private float $potencia;

    public function __construct(float $potencia)
    {
        $this->potencia = $potencia;
    }

    public function calcular()
    {
        return $this->getMargem();
    }

    public function getMargem(): float
    {
        $margens = (new PrecificacaoPrincipal())->padrao();
        if ($margens->isEmpty()) throw new \DomainException('Cadastre margens de vendas de kits em precificação de produtos.');
        foreach ($margens as $index => $item) {
            if ($item->potencia >= $this->potencia) return $item->margem;
        }
        return $margens[$index]->margem;
    }
}
