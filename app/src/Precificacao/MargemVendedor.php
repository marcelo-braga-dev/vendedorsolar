<?php

namespace App\src\Precificacao;

class MargemVendedor
{
    private string $chave = 'vendedor';

    public function getChave(): string
    {
        return $this->chave;
    }
}
