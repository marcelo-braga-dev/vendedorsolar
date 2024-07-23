<?php

namespace App\Http\Controllers\Admin\Integracoes;

class OrigensIntegracoes
{
    public function getKeyAldo()
    {
        return 'aldo';
    }

    public function getKeyExcel()
    {
        return 'excel';
    }

    public function getNomes()
    {
        return [
            $this->getKeyAldo() => 'Integração Aldo',
            $this->getKeyExcel() => 'Planilha Excel'
        ];
    }
}
