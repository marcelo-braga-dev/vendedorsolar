<?php

namespace App\src\Integracoes\Aldo;

use App\Models\IntegracaoAldo;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Requisicao
{
    private $zip;

    public function getZip(): string
    {
        $chavesIntegracao = new IntegracaoAldo();
        $chaves = $chavesIntegracao->chaves();

        $client = new Client(['verify' => false]);
        try {
            $promise = $client->requestAsync(
                'GET',
                'https://webservice.aldo.com.br/asp.net/ferramentas/integracaozip.ashx?u=' . $chaves['codigo'] . '&p=' . $chaves['chave']
            );
            $promise->then(function ($response) {
                $this->zip = $response->getBody()->getContents();
            });

            $promise->wait();
        } catch (ClientException $e) {
            throw new \DomainException('Horário de acesso não permitido.');
        }
        return $this->zip;
    }
}
