<?php

namespace App\Services;

use App\Models\Estruturas;

class EstruturasService
{
    public function get_estruturas()
    {
        return Estruturas::get();
    }

    public function get_estrutura($id)
    {
        $clsEstrutura = new Estruturas();

        return $clsEstrutura->find($id);
    }
}