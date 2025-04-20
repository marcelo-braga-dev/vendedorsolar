<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use Illuminate\Support\Facades\Http;

class Requisicao
{
    public function getProdutos($token, $page)
    {
        $url = 'https://api.edeltecsolar.com.br/produtos/integration';

        return Http::withToken($token)
            ->get($url, [
                'limit' => '1000',
                'page' => $page,
                'tipo' => 'GERADOR FOTOVOLTAICO,GERADOR MICROINVERSOR'
            ])->json();
    }
}
