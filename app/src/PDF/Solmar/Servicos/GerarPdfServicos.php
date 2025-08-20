<?php

namespace App\src\PDF\Solmar\Servicos;

class GerarPdfServicos
{
    public function gerar(int $id)
    {
        return (new Construtor())->gerar($id);
    }
}
