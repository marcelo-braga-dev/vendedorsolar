<?php

namespace App\src\Produtos\CalculoPrecos;

use App\Models\PrecificacaoPrincipal;
use Illuminate\Support\Collection;

class MargensPadrao implements Margens
{
    private static ?Collection $cache = null;

    private float $potencia;

    public function __construct(float $potencia)
    {
        $this->potencia = $potencia;
    }

    public function calcular(): float
    {
        return $this->getMargem();
    }

    public function getMargem(): float
    {
        $margens = $this->margens();

        $ultima = null;
        foreach ($margens as $item) {
            $ultima = $item;
            if ($item->potencia >= $this->potencia) {
                return (float) $item->margem;
            }
        }

        return (float) $ultima->margem;
    }

    private function margens(): Collection
    {
        if (self::$cache === null) {
            self::$cache = (new PrecificacaoPrincipal())->padrao();

            if (self::$cache->isEmpty()) {
                throw new \DomainException('Cadastre margens de vendas de kits em precificação de produtos.');
            }
        }

        return self::$cache;
    }

    public static function limparCache(): void
    {
        self::$cache = null;
    }
}
