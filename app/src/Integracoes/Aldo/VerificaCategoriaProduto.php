<?php

namespace App\src\Integracoes\Aldo;

use App\src\Integracoes\Aldo\Produtos\KitOnGrid;
use App\src\Integracoes\Aldo\Produtos\Trafos;
use App\src\Produtos\Kit;

class VerificaCategoriaProduto
{
    public function categoria($produto, $indices)
    {
        if (
            $produto->marca_site == 'ALDO SOLAR ON GRID' &&
            $produto->atributos->TIPO_PRODUTO == 'GERADOR' &&
            $produto->segmento_site == 'ENERGIA SOLAR'
        ) {
            return new KitOnGrid($produto, $indices);
        }
        if (
            $produto->atributos->TIPO_PRODUTO == 'TRANSFORMADOR' &&
            $produto->segmento_site == 'ENERGIA SOLAR'
        ) {
            return new Trafos($produto, $indices);
        }
        return null;
    }
}
