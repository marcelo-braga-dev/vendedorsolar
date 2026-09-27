<?php

namespace App\src\PDF\CasaVerde;

class Config
{
    private $mpdf;

    public function __construct($mpdf)
    {
        $this->mpdf = $mpdf;
    }

    public function configurar()
    {
        $this->mpdf->SetTitle('Orçamento Casa Verde');
        $this->mpdf->SetAuthor('Autor');
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->allow_charset_conversion = true;

        return $this->mpdf;
    }
}
