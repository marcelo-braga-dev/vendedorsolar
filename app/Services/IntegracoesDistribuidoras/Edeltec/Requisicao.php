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

    public function get($token, $pagina)
    {
        $qtds = 0;
        $integracoesDados = (new IntegracaoEdeltec())->dados();

        $items = $this->requisicao($token, $pagina);

        foreach ($items as $item) {
            if ($item['codProd'] ?? null) {
                $kit = (new KitOnGrid($item, $integracoesDados));
                $kit->cadastrar();
            }
        }
    }

    private function fase($fase)
    {
        if ($fase == 'Monofásico') return 1;
        if ($fase == 'Bifásico') return 2;
        if ($fase == 'Trifásico') return 3;
    }
}
