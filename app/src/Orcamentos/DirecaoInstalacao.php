<?php

namespace App\src\Orcamentos;

class DirecaoInstalacao
{
    public function direcoes()
    {
        return [
            'desconsiderar' => 'Desconsiderar',
            'norte' => 'Norte',
            'sudeste_noroeste' => 'Sudeste/Noroeste',
            'leste_oeste' => 'Leste/Oeste',
            'sul' => 'Sul'
        ];
    }
}
