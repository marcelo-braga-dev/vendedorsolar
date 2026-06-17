<?php

namespace App\Http\Middleware\Auth;

use App\Models\LojaApiAcesso;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LojaApiToken
{
    /**
     * Garante que a requisição traga o token da loja via "Authorization: Bearer <token>"
     * e registra cada chamada (autorizada ou não) no histórico de acessos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\JsonResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $tokenValido = config('services.loja.api_token');

        if (empty($tokenValido) || !$token || !hash_equals($tokenValido, $token)) {
            $this->registrarAcesso($request, 401);

            return response()->json(['message' => 'Não autorizado.'], 401);
        }

        $response = $next($request);

        $this->registrarAcesso($request, $response->getStatusCode());

        return $response;
    }

    private function registrarAcesso(Request $request, int $status): void
    {
        try {
            LojaApiAcesso::create([
                'ip'         => $request->ip(),
                'metodo'     => $request->method(),
                'rota'       => $request->path(),
                'parametros' => $request->query() ? json_encode($request->query()) : null,
                'sku'        => $request->route('sku'),
                'status'     => $status,
            ]);
        } catch (\Throwable $e) {
            Log::channel('loja_api')->error('Falha ao registrar histórico de acesso', ['erro' => $e->getMessage()]);
        }
    }
}
