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
        $token = $body['token']
            ?? $body['access_token']
            ?? $body['accessToken']
            ?? null;

        // Quando a resposta não é JSON (ex.: Content-Type text/html), a API devolve
        // o próprio token JWT como corpo em texto puro.
        return $token ?? trim($response->body());
    }
}
