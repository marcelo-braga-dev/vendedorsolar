<?php

namespace App\Http\Controllers\Admin\Integracoes\Edeltec;

use App\Models\IntegracaoEdeltec;
use App\Services\IntegracoesDistribuidoras\Edeltec\Integracoes;
use App\Services\IntegracoesDistribuidoras\Edeltec\KitOnGrid;
use App\Services\IntegracoesDistribuidoras\Edeltec\Requisicao;

class EdeltecIntegracao
{
    public function init()
    {
        $token = (new Integracoes())->autenticar();
        $integracaoDados = (new IntegracaoEdeltec())->dados();

        $page = 1;

        while (true) {
            $resposta = (new Requisicao())->getProdutos($token, $page);
            $itens = $resposta['items'] ?? [];
            $totalPages = $resposta['meta']['totalPages'] ?? 0;

            // Verifica se há dados a serem processados
            if (!empty($itens)) {
                foreach ($itens as $produto) {
                    if (isset($produto['codProd'])) {
                        try {
                            $kit = new KitOnGrid($produto, $integracaoDados);
                            $kit->cadastrar();
                        } catch (\DomainException $exception) {
                            \Log::info($exception->getMessage());
                        }
                    }
                }
            }

            // Se não houver mais páginas, encerra
            if ($totalPages == $page) {
                break;
            }

            $page++;
        }
        \Log::info('INTEGRACAO EDELTEC REALIZADA COM SUCESSO');
    }
}
