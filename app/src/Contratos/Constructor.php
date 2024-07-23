<?php

namespace App\src\Contratos;

use App\Models\Contratos;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class Constructor
{
    private $mpdf;

    public function __construct()
    {
        try {
            $this->mpdf = new Mpdf([
                "format" => "A4",
                'margin_top' => 20,
                'margin_bottom' => 30,
                'margin_left' => 20,
                'margin_right' => 20
            ]);
        } catch (MpdfException $e) {
            echo $e->getMessage();
        }
    }

    public function gerar($id)
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $dados = (new Contratos())->newQuery()->findOrFail($id);
        $valorExtenso = (new FormatarDinheiro())->valorPorExtenso($dados->valor_projeto);

        $this->mpdf->SetHTMLHeader(view('pages.pdf.phennixsolar.contratos.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.phennixsolar.contratos.template.rodape'));

        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->allow_charset_conversion = true;

        $this->mpdf->WriteHTML(view('pages.pdf.phennixsolar.contratos.index',
            compact('dados', 'valorExtenso')));

        $this->mpdf->Output('Contrato - ' . $dados->nome_cliente . '.pdf', 'I');
    }
}
