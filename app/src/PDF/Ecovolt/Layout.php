<?php

namespace App\src\PDF\Ecovolt;

use Mpdf\HTMLParserMode;

class Layout
{
    private $mpdf;

    public function __construct($mpdf)
    {
        $this->mpdf = $mpdf;
    }
    public function configurar()
    {
        $this->mpdf->WriteHTML(view('pages.pdf.ecovolt.assets.css'), HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetHTMLHeader(view('pages.pdf.ecovolt.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.ecovolt.template.rodape'));
        return $this->mpdf;
    }
}
