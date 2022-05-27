<?php

namespace App\src\Produtos\Precificacao;

use App\Models\Kits;
use App\Models\MargensVenda;

class MargemPadrao
{
    private $minPotencia;
    private $maxMargem;

    public function __construct()
    {
        $this->minPotencia = 0;
        $this->maxMargem = 0;
    }

    public function atualizaPrecoMargemPagrao()
    {
        $margensVendas = new MargensVenda();
        $margensPadrao = $margensVendas->newQuery()
            ->where('nome', '=', 'padrao')
            ->orderBy('potencia')
            ->get(['id', 'potencia', 'margem', 'updated_at']);

        foreach ($margensPadrao as $margemPadrao) {
            $kits = $this->getKits($margemPadrao->potencia);
            $this->atualizar($kits, $margemPadrao->margem);
        }

        $kits = $this->getKits(10000);
        $this->atualizar($kits, $this->maxMargem);
    }

    private function getKits($potencia)
    {
        $clsKits = new Kits();
        $kits = $clsKits->newQuery()
            ->where('potencia_kit', '>', $this->minPotencia)
            ->where('potencia_kit', '<=', $potencia)
            ->get(['id', 'preco_fornecedor', 'margem']);

        $this->minPotencia = $potencia;

        return $kits;
    }

    private function atualizar($kits, $margemPadrao): void
    {
        $this->maxMargem = $margemPadrao;
        $clsKits = new Kits();

        foreach ($kits as $kit) {
            $preco = $kit->preco_fornecedor * (1 + $margemPadrao / 100);

            if ($kit->margem != $margemPadrao) {

                $clsKits->newQuery()
                    ->find($kit->id)
                    ->update([
                        'preco_cliente' => $preco,
                        'margem' => $margemPadrao
                    ]);
            }
        }
    }
}
