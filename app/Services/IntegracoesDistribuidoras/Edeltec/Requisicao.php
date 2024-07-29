<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use App\Models\IntegracaoEdeltec;
use App\Models\Produtos;
use App\Models\ProdutosMarcas;
use App\src\Orcamentos\EstruturasGeradores;
use App\src\Produtos\Kit;
use Illuminate\Support\Facades\Http;

class Requisicao
{
    private function requisicao($token, $page)
    {
        $url = 'https://api.edeltecsolar.com.br/produtos/integration';

        $response = Http::withToken($token)
            ->get($url, [
                'limit' => '5000',
                'page' => $page,
                'tipo' => 'GERADOR FOTOVOLTAICO'
            ])->json();

        return $response['items'];
    }

    public function get($token)
    {
        $qtds = 0;
        $integracoesDados = (new IntegracaoEdeltec())->dados();

        $marcasEdeltec = [];
        for ($i = 1; $i <= 6; $i++) {
            $items = $this->requisicao($token, $i);

            foreach ($items as $item) {
                if ($item['codProd'] ?? null) {
//                    $marcasEdeltec[$item['marca']] = $item['marca'];
//                    $marcasEdeltec[$item['fabricante']] = $item['fabricante'];
                    $kit = (new KitOnGrid($item, $integracoesDados));
                    $kit->cadastrar();
//
//                    ProdutosKitsSolar::updateOrCreate(['sku' => $produtoData['sku']], $produtoData);
//                    $qtds++;
                }
            }
        }
        print_pre($marcasEdeltec);
//        (new ProdutosIntegracoesHistoricos())->create(1, $qtds);
    }

    private function fase($fase)
    {
        if ($fase == 'Monofásico') return 1;
        if ($fase == 'Bifásico') return 2;
        if ($fase == 'Trifásico') return 3;
    }
}
