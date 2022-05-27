<?php

namespace App\src\Produtos\CalculoPrecos;

use App\Models\MargensVenda;
use Illuminate\Database\Eloquent\Collection;

class MargensPadrao implements Margens
{
    private float $valor;
    private float $potencia;
    private Collection $margens;

    public function __construct(float $valor, float $potencia)
    {
        $this->valor = $valor;
        $this->potencia = $potencia;
        $this->margens = $this->margens();
    }

    private function margens(): Collection
    {
        $margensVenda = new MargensVenda();

        return $margensVenda->newQuery()
            ->where('nome', '=', 'padrao')
            ->orderBy('potencia', 'ASC')
            ->get(['potencia', 'margem']);
    }

    public function calcular(): array
    {
        $margem = $this->getMargem();

        $preco = $this->valor * (1 + ($margem / 100));

        return ['preco' => $preco, 'margem' => $margem];
    }

    private function getMargem(): float
    {
        foreach ($this->margens as $index => $item) {
            if ($item->potencia >= $this->potencia) return $item->margem;
        }

        return !empty($this->margens[$index]) ? $this->margens[$index]->margem : 0;
    }
}
