<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

class SelecionaTrafo extends SelecionaTrafoDB
{
    public function analizaTrafo($item, $tensao)
    {
        if ($item->potencia_inversor < 1) return $item;

        if ($item->tensao > $tensao) {
            $this->getTrafo($item);
        }

        return $item;
    }
}
