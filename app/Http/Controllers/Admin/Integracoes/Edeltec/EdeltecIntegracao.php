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
        $skuAtivos = [];

        while (true) {
            $resposta = (new Requisicao())->getProdutos($token, $page);
            $itens = $resposta['items'] ?? [];
            $totalPages = $resposta['meta']['totalPages'] ?? 0;

            if (!empty($itens)) {
                foreach ($itens as $produto) {
                    if (isset($produto['codProd'])) {
                        // Armazena o SKU ativo
                        $skuAtivos[] = $produto['codProd'];

                        try {
                            $kit = new KitOnGrid($produto, $integracaoDados);
                            $kit->cadastrar();
                        } catch (\DomainException $exception) {
                            \Log::info("ERRO INTEGRACAO EDELTEC: " . $exception->getMessage());
                        }
                    }
                }
            }

            if ($totalPages == $page) {
                break;
            }

            $page++;
        }

        // Atualiza status para 0 de todos os produtos que NÃO estão em $skuAtivos
        \DB::table('produtos')
            ->whereNotIn('codProd', $skuAtivos)
            ->update(['status' => 0]);

        \Log::info('INTEGRACAO EDELTEC REALIZADA COM SUCESSO');
    }
}
