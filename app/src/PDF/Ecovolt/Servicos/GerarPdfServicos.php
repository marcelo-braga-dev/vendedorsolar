<?php

namespace App\src\PDF\Ecovolt\Servicos;

class GerarPdfServicos
{
    public function gerar(int $id)
    {
        return (new Construtor())->gerar($id);
    }
}
