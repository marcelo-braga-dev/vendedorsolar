<?php

namespace App\src\PDF\Solmar\Contratos;

class GerarPdfContrato
{
    public function gerar(int $id)
    {
        return (new Construtor())->gerar($id);
    }
}
