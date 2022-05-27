<?php

namespace App\src\PDF\BahiaSolar;

use App\src\PDF\BahiaSolar\Sessoes\Assinaturas;
use App\src\PDF\BahiaSolar\Sessoes\Beneficios;
use App\src\PDF\BahiaSolar\Sessoes\Capa;
use App\src\PDF\BahiaSolar\Sessoes\Graficos;
use App\src\PDF\BahiaSolar\Sessoes\Imagenskit;
use App\src\PDF\BahiaSolar\Sessoes\InfoKit;
use App\src\PDF\BahiaSolar\Sessoes\InfoPredio;
use App\src\PDF\BahiaSolar\Sessoes\Introducao;
use App\src\PDF\BahiaSolar\Sessoes\Portfolio;
use App\src\PDF\BahiaSolar\Sessoes\Regulamentacao;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class BahiaSolarPDF extends DadosOrcamento
{
    public Mpdf $mpdf;
    private string $graficoGeracao;
    private string $graficoPayback;

    public function __construct(int $idOrcamento, string $graficoGeracao, string $graficoPayback)
    {
        parent::__construct($idOrcamento);

        try {
            $this->mpdf = new Mpdf([
                "format" => "A4",
                'margin_top' => 0,
                'margin_bottom' => 0,
                'margin_left' => 0,
                'margin_right' => 0
            ]);
        } catch (MpdfException $e) {
            echo $e->getMessage();
        }
        $this->graficoGeracao = $graficoGeracao;
        $this->graficoPayback = $graficoPayback;
    }

    public function gerar()
    {
        $this->config();
        $this->layout();
        $pageBreakAfter = '<div style="page-break-after: always;"></div>';

        $body = new Body();

        $this->mpdf = $body->execute(new Capa(), $this);
        $this->mpdf = $body->execute(new Introducao(), $this);
        $this->mpdf = $body->execute(new Beneficios(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new InfoPredio(), $this);
        $this->mpdf = $body->execute(new InfoKit(), $this);
        $this->mpdf = $body->execute(new Imagenskit(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new Graficos($this->graficoGeracao, $this->graficoPayback), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new Portfolio(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new Regulamentacao(), $this);
        $this->mpdf = $body->execute(new Assinaturas(), $this);

        $this->mpdf->Output('Orcamento.pdf', 'I');
    }

    private function config()
    {
        $config = new Config($this->mpdf);
        $this->mpdf = $config->configurar();
    }

    private function layout()
    {
        $layout = new Layout($this->mpdf);
        $this->mpdf = $layout->configurar();
    }
}
