<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

class SelecionaTrafo extends SelecionaTrafoDB
{
    public function analizaTrafo($item, $tensao)
    {
        if ($item->tensao > $tensao) {
            $this->getTrafo($item);
        }
    }
}
