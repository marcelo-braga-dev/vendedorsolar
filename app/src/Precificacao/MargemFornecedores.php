<?php

namespace App\src\Precificacao;

class MargemFornecedores
{
    private string $chave = 'fornecedor';

    public function getChave(): string
    {
        return $this->chave;
    }
}
