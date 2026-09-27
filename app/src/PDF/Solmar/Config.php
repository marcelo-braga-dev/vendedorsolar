<?php

namespace App\src\PDF\Solmar;

class Config
{
    private $mpdf;

    public function __construct($mpdf)
    {
        $this->mpdf = $mpdf;
    }

    public function configurar()
    {
        $this->mpdf->SetTitle('Orçamento Gerador Solar');
        $this->mpdf->SetAuthor('Autor');
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->allow_charset_conversion = true;

        return $this->mpdf;
    }
}
