<?php

namespace App\src\PDF\Padrao;

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
        $this->mpdf->WriteHTML(view('pages.pdf.padrao.assets.css'), HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetHTMLHeader(view('pages.pdf.padrao.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.padrao.template.rodape'));

        return $this->mpdf;
    }
}
