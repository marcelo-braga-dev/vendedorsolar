<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use Illuminate\Support\Facades\Http;

class Integracoes
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.edeltec.base_url'), '/');
    }

    public function autenticar(): string
    {
        $response = Http::withHeader('Content-Type', 'application/json')
            ->post("{$this->baseUrl}/api-access/token", [
                'apiKey' => config('services.edeltec.api_key'),
                'secret' => config('services.edeltec.secret'),
            ]);

        if (!$response->successful()) {
            return '';
        }

        $body = $response->json();

        // A API pode retornar o token em campos diferentes; tenta os mais comuns.
        return $body['token']
            ?? $body['access_token']
            ?? $body['accessToken']
            ?? '';
    }
}
