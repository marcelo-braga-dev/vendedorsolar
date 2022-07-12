<?php

namespace App\src\PDF\Padrao;

class Config
{
    private $mpdf;

    public function __construct($mpdf)
    {
        $this->mpdf = $mpdf;
    }

    public function configurar()
    {
        $this->mpdf->SetTitle('Titulo Arquivo');
        $this->mpdf->SetAuthor('Autor');
        $this->mpdf->SetWatermarkText("Modelo");
        $this->mpdf->showWatermarkText = true;
        $this->mpdf->watermark_font = 'DejaVuSansCondensed';
        $this->mpdf->watermarkTextAlpha = 0.5;
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->allow_charset_conversion = true;

        return $this->mpdf;
    }
}
