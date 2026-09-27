<?php

namespace App\src\PDF\CasaVerde;

use App\src\PDF\CasaVerde\Sessoes\Assinaturas;
use App\src\PDF\CasaVerde\Sessoes\Bancos;
use App\src\PDF\CasaVerde\Sessoes\Beneficios;
use App\src\PDF\CasaVerde\Sessoes\Capa;
use App\src\PDF\CasaVerde\Sessoes\Imagenskit;
use App\src\PDF\CasaVerde\Sessoes\InfoKit;
use App\src\PDF\CasaVerde\Sessoes\InfoPredio;
use App\src\PDF\CasaVerde\Sessoes\Introducao;
use App\src\PDF\CasaVerde\Sessoes\Regulamentacao;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Illuminate\Support\Facades\Storage;

class Construtor extends DadosOrcamento
{
    public Mpdf $mpdf;

    public function __construct(int $idOrcamento)
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
            Log::error('Erro ao criar Mpdf: ' . $e->getMessage());
            throw $e; // Impede que o código continue com mpdf não inicializado
        }
    }

    public function gerar()
    {
        $orcamento = $this->getOrcamento();

        if (empty($orcamento)) {
            Log::error('Erro ao gerar PDF Casa Verde: orçamento não encontrado.');
            return response()->json(['error' => 'Orçamento não encontrado.'], 404);
        }

        if (empty($this->getCliente())) {
            Log::error("Erro ao gerar PDF Casa Verde: orçamento #{$orcamento->id} sem cliente vinculado.");
            return response()->json(['error' => 'Este orçamento não possui um cliente vinculado.'], 422);
        }

        if (empty($this->getOrcamentoKit()) || empty($this->getKit())) {
            Log::error("Erro ao gerar PDF Casa Verde: orçamento #{$orcamento->id} sem kit vinculado.");
            return response()->json(['error' => 'Este orçamento não possui um kit de produtos vinculado.'], 422);
        }

        $this->config();
        $pageBreakAfter = '<div style="page-break-after: always;"></div>';

        $body = new Body();
        $body->execute(new Capa(), $this);
        // Cabeçalho/rodapé só a partir da 2ª página (a capa é full-bleed, sem faixa de header/footer).
        // O header/footer de uma página fica travado no momento em que ela é criada via AddPage,
        // por isso layout() precisa rodar ANTES do AddPage que abre a página 2.
        $this->layout();
        $this->mpdf->AddPage('', '', '', '', '', 0, 0, 37, 15, 0, 0);//esq;dir;cima;baixo;cab;pe
        $body->execute(new Introducao(), $this);
        $body->execute(new Beneficios(), $this);
        $body->execute(new Bancos(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $body->execute(new InfoPredio(), $this);
        $body->execute(new InfoKit(), $this);
        $body->execute(new Imagenskit(), $this);
        $this->mpdf->WriteHTML($pageBreakAfter);
        $body->execute(new Regulamentacao(), $this);
        $body->execute(new Assinaturas(), $this);

        $nomeArquivo = getNomeCliente($orcamento->clientes_id) . '_' . $orcamento->geracao . 'kwh_casa-verde_' . uniqid() . '.pdf';
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
