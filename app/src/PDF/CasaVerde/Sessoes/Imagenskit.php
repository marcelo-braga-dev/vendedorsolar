<?php

namespace App\src\PDF\CasaVerde\Sessoes;

use App\Models\Kits;
use App\Models\Produtos;
use App\src\PDF\CasaVerde\DadosOrcamento;

class Imagenskit implements Sessao
{
    public function index(DadosOrcamento $dados)
    {
        $kit = $dados->getKit();
        $orcamentoKit = $dados->getOrcamentoKit();
        $trafo = $dados->getTrafo();
        $imagens = $this->getImagensDosProdutos($kit, $trafo);

        $dados->mpdf->WriteHTML(view('pages.pdf.casaverde.sessoes.imagens-kit',
            compact('imagens', 'kit', 'orcamentoKit', 'trafo')));

        return $dados->mpdf;
    }

    private function getImagensDosProdutos($kit, $trafo): array
    {
        $ids = array_filter([$kit->marca_inversor, $kit->marca_painel, $trafo->produtos_id ?? null]);

        return Produtos::whereIn('id', $ids)->get()
            ->mapWithKeys(fn($item) => [$item->id => [
                'nome' => $item->nome,
                'logo' => $item->img_logo,
                'produto' => $item->img_produto,
                'garantia' => $item->garantia,
            ]])
            ->all();
    }
}
