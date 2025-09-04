<?php

namespace App\src\PDF\Ecovolt;

use App\src\PDF\Ecovolt\Sessoes\Assinaturas;
use App\src\PDF\Ecovolt\Sessoes\Bancos;
use App\src\PDF\Ecovolt\Sessoes\Beneficios;
use App\src\PDF\Ecovolt\Sessoes\Capa;
use App\src\PDF\Ecovolt\Sessoes\Graficos;
use App\src\PDF\Ecovolt\Sessoes\Imagenskit;
use App\src\PDF\Ecovolt\Sessoes\InfoKit;
use App\src\PDF\Ecovolt\Sessoes\InfoPredio;
use App\src\PDF\Ecovolt\Sessoes\Introducao;
use App\src\PDF\Ecovolt\Sessoes\Portfolio;
use App\src\PDF\Ecovolt\Sessoes\ProdutosKit;
use App\src\PDF\Ecovolt\Sessoes\Regulamentacao;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class Construtor extends DadosOrcamento
{
    public Mpdf $mpdf;
    private string $graficoGeracao;
    private string $graficoPayback;

    public function __construct(int $idOrcamento, string $graficoGeracao, string $graficoPayback)
    {
        parent::__construct($idOrcamento);

        try {
            $this->mpdf = new Mpdf([
                'tempDir' => storage_path('app/tmp'),
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
        $this->mpdf = $body->execute(new Bancos(), $this);
        $this->mpdf = $body->execute(new Beneficios(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new InfoPredio(), $this);
        $this->mpdf = $body->execute(new InfoKit(), $this);
        $this->mpdf = $body->execute(new Imagenskit(), $this);
        $this->mpdf = $body->execute(new ProdutosKit(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new Graficos($this->graficoGeracao, $this->graficoPayback), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new Portfolio(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $this->mpdf = $body->execute(new Regulamentacao(), $this);
        $this->mpdf = $body->execute(new Assinaturas(), $this);

        $orcamento = $this->getOrcamento();

        $nomeArquivo = getNomeCliente($orcamento->clientes_id) . '_' . $orcamento->geracao . 'kwh_' . uniqid() . '.pdf';
        $caminhoRelativo = 'public/pdfs/' . $nomeArquivo;
        $caminhoCompleto = storage_path('app/' . $caminhoRelativo);
        $this->mpdf->Output($caminhoCompleto, 'F');
        $urlPublica = Storage::url('pdfs/' . $nomeArquivo);

        return response()->json(['urlPdf' => $urlPublica]);
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
