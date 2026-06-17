<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use Illuminate\Support\Facades\Http;

class Requisicao
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.edeltec.base_url'), '/');
    }

    /**
     * Busca uma página de produtos da API.
     *
     * @throws \RuntimeException em caso de falha HTTP não recuperável.
     */
    public function getProdutos(string $token, int $page): array
    {
        $response = $this->request($token, $page);

        // Tenta uma vez em caso de erro de servidor (5xx transitório)
        if ($response->serverError()) {
            sleep(3);
            $response = $this->request($token, $page);
        }

        if (!$response->successful()) {
            throw new \RuntimeException(
                "API Edeltec retornou HTTP {$response->status()} na página {$page}."
            );
        }

        return $response->json() ?? [];
    }

    private function request(string $token, int $page)
    {
        return Http::withToken($token)
            ->timeout(30)
            ->get("{$this->baseUrl}/produtos/integration", [
                'limit' => 1000,
                'page'  => $page,
                'tipo'  => 'GERADOR FOTOVOLTAICO,GERADOR MICROINVERSOR,GERADOR HIBRIDO',
            ]);
    }
}
