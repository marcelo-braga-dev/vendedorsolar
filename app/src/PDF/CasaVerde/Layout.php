<?php

namespace App\src\PDF\CasaVerde;

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
        $this->mpdf->WriteHTML(view('pages.pdf.casaverde.assets.css'), HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetHTMLHeader(view('pages.pdf.casaverde.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.casaverde.template.rodape'));
        return $this->mpdf;
    }
}
