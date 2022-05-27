<?php

namespace App\src\Integracoes\Aldo;

use App\Models\IntegracaoAldo;
use GuzzleHttp\Client;

class Requisicao
{
    private $zip;

    public function getZip(): string
    {
        $chavesIntegracao = new IntegracaoAldo();
        $chaves = $chavesIntegracao->chaves();

        $client = new Client(['verify' => false]);

        $promise = $client->requestAsync(
            'GET',
            'https://webservice.aldo.com.br/asp.net/ferramentas/integracaozip.ashx?u=' . $chaves['codigo'] . '&p=' . $chaves['chave']
        );

        $promise->then(function ($response) {
            $this->zip = $response->getBody()->getContents();
        });

        $promise->wait();

        return $this->zip;
    }


}
