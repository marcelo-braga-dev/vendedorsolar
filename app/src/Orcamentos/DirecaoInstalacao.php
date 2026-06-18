<?php

namespace App\src\Orcamentos;

class DirecaoInstalacao
{
    public function direcoes()
    {
        return [
            'desconsiderar' => 'Desconsiderar',
            'norte' => 'Norte',
            'nordeste_noroeste' => 'Nordeste/Noroeste',
            'leste_oeste' => 'Leste/Oeste',
            'sudeste_sudoeste' => 'Sudeste/Sudoeste',
            'sul' => 'Sul'
        ];
    }
}
