<?php

namespace App\src\PDF\Ecovolt\Servicos;

use App\Repositories\Propostas\Servicos\ServicosRepository;
use App\src\PDF\Solmar\Body;
use Illuminate\Support\Facades\Log;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Illuminate\Support\Facades\Storage;

class Construtor
{
    public Mpdf $mpdf;

    public function gerar(int $idProposta)
    {
        $dados = (new ServicosRepository())->find($idProposta);

        $this->config();
        $this->layout();

        $this->mpdf->AddPage('', '', '', '', '', 0, 0, 37, 15, 0, 0);

        $this->mpdf = (new Conteudo())->index($this, $dados);

        $nomeArquivo = uniqid() . '.pdf';
        $caminhoRelativo = 'public/pdfs/' . $nomeArquivo;
        $caminhoCompleto = storage_path('app/' . $caminhoRelativo);
        $this->mpdf->Output($caminhoCompleto, 'F');
        $urlPublica = Storage::url('pdfs/' . $nomeArquivo);

        return response()->json(['urlPdf' => $urlPublica]);
    }

    private function config()
    {
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
            Log::error('Erro ao criar Mpdf: ' . $e->getMessage());
            throw $e; // Impede que o código continue com mpdf não inicializado
        }

        $this->mpdf->SetTitle('Orçamento Gerador Solar');
        $this->mpdf->SetAuthor('Autor');
        $this->mpdf->SetWatermarkText("Modelo 1");
        $this->mpdf->showWatermarkText = false;
        $this->mpdf->watermark_font = 'DejaVuSansCondensed';
        $this->mpdf->watermarkTextAlpha = 0.5;
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->allow_charset_conversion = true;
    }

    private function layout()
    {
        $this->mpdf->WriteHTML(view('pages.pdf.ecovolt.assets.css'), HTMLParserMode::HEADER_CSS);
        $this->mpdf->SetHTMLHeader(view('pages.pdf.ecovolt.template.cabecalho'));
        $this->mpdf->SetHTMLFooter(view('pages.pdf.ecovolt.template.rodape'));
    }
}
