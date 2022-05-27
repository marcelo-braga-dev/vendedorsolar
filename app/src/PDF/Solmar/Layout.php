<?php

namespace App\src\PDF\Solmar;

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
        $this->mpdf->WriteHTML(view('pages.pdf.modelo_1.assets.css'), HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetHTMLHeader(view('pages.pdf.modelo_1.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.modelo_1.template.rodape'));
        $this->mpdf->WriteHTML(view('pages.pdf.modelo_1.template.capa'), HTMLParserMode::HTML_BODY);

        $this->mpdf->AddPage('', '', '', '', '', 0, 0, 37, 15, 0, 0);//esq;dir;cima;baixo;cab;pe

        return $this->mpdf;
    }
}
