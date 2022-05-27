<?php

namespace App\src\PDF\BahiaSolar;

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
        $this->mpdf->WriteHTML(view('pages.pdf.bahia-solar.assets.css'), HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetHTMLHeader(view('pages.pdf.bahia-solar.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.bahia-solar.template.rodape'));

        return $this->mpdf;
    }
}
