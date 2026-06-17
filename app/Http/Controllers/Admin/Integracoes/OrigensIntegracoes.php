<?php

namespace App\Http\Controllers\Admin\Integracoes;

class OrigensIntegracoes
{
    public function getKeyExcel()
    {
        return 'excel';
    }

    public function getNomes()
    {
        return [
            $this->getKeyExcel() => 'Planilha Excel'
        ];
    }
}
