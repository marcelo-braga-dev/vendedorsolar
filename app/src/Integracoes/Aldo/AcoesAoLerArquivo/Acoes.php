<?php

namespace App\src\Integracoes\Aldo\AcoesAoLerArquivo;

interface Acoes
{
    public function executar($dados, $indices);
}
