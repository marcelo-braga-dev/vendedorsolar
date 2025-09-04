<?php

namespace App\Http\Controllers\Admin\Integracoes\Edeltec;

use App\Models\Fornecedores;
use App\Models\Integracao\Edeltec\IntegracaoEdeltecHistorico;
use App\Models\IntegracaoEdeltec;
use App\Models\Kits;
use App\Services\IntegracoesDistribuidoras\Edeltec\Integracoes;
use App\Services\IntegracoesDistribuidoras\Edeltec\KitOnGrid;
use App\Services\IntegracoesDistribuidoras\Edeltec\Requisicao;
use Illuminate\Support\Facades\Log;

class EdeltecIntegracao
{
    public $historico;

    public function init(): void
    {
        $this->createHistorico();

        // Autenticação
        $this->atualizarStatus('Autenticando');
        $token = (new Integracoes())->autenticar();
        if (empty($token)) {
            $this->fail('Falha na autenticação (token vazio).');
            return;
        }

        // Config da integração
        $integracaoDados = (new IntegracaoEdeltec())->dados();
        if (empty($integracaoDados)) {
            $this->fail('Dados de integração não configurados.');
            return;
        }

        $this->atualizarStatus('Buscando Produtos');

        $page      = 1;
        $skuAtivos = [];
        $req       = new Requisicao();

        while (true) {
            $resposta    = $req->getProdutos($token, $page);
            $items       = (array)($resposta['items'] ?? []);
            $meta        = (array)($resposta['meta'] ?? []);
            $totalPages  = (int)($meta['totalPages'] ?? 0);

            $this->atualizarStatus("Separando Produtos (página {$page})");

            if (!empty($items)) {
                foreach ($items as $produto) {
                    $sku = $produto['codProd'] ?? null;
                    if (!$sku) {
                        continue;
                    }

                    $skuAtivos[] = $sku;

                    try {
                        (new KitOnGrid($produto, $integracaoDados))->cadastrar();
                    } catch (\DomainException $e) {
                        $this->appendNota("SKU {$sku}: " . $e->getMessage());
                        Log::warning('Edeltec cadastro (DomainException)', ['sku' => $sku, 'msg' => $e->getMessage()]);
                    } catch (\Throwable $e) {
                        $this->appendNota("SKU {$sku}: erro inesperado.");
                        Log::error('Edeltec cadastro (Throwable)', ['sku' => $sku, 'ex' => $e]);
                    }
                }
            }

            // Encerramento por paginação (se informado)
            if ($totalPages > 0 && $page >= $totalPages) {
                break;
            }

            // Se a API não informar totalPages e não vier item, encerra
            if ($totalPages === 0 && empty($items)) {
                break;
            }

            $page++;
        }

        // Normaliza SKUs importados
        $skuAtivos = array_values(array_unique($skuAtivos));
        $this->historico->produtos_importados = $skuAtivos;
        $this->historico->save();

        // Fornecedor Edeltec
        $idFornecedor = Fornecedores::query()
            ->where('nome', 'EDELTEC')
            ->value('id');

        if (empty($idFornecedor)) {
            $this->fail('Fornecedor "EDELTEC" não encontrado.');
            return;
        }

        // Desativar produtos do fornecedor que não vieram na importação atual
        $query = Kits::query()->where('fornecedor', $idFornecedor);
        if (!empty($skuAtivos)) {
            $query->whereNotIn('sku', $skuAtivos);
        }
        // se $skuAtivos estiver vazio, desativa todos do fornecedor

        $skuDesativar = $query->pluck('sku')->toArray();
        $qtdDesativar = count($skuDesativar);

        if ($qtdDesativar > 0) {
            Kits::query()
                ->where('fornecedor', $idFornecedor)
                ->whereIn('sku', $skuDesativar)
                ->update([
                    'status'            => 0,
                    'status_fornecedor' => 0,
                ]);
        }

        $this->historico->qtd_desativados      = $qtdDesativar;
        $this->historico->produtos_desativados = $skuDesativar;
        $this->historico->save();

        $this->atualizarStatus('Concluído');
    }

    private function createHistorico(): void
    {
        $this->historico = IntegracaoEdeltecHistorico::create([
            'data_inicio' => now(),
            'status'      => 'Iniciando',
        ]);
    }

    private function atualizarStatus(string $status): void
    {
        $this->historico->status = $status;
        $this->historico->save();
    }

    private function appendNota(string $texto): void
    {
        $atual = (string)($this->historico->anotacoes ?? '');
        $novo  = trim($atual . (strlen($atual) ? PHP_EOL : '') . $texto);
        $this->historico->anotacoes = $novo;
        $this->historico->save();
    }

    private function fail(string $mensagem): void
    {
        $this->atualizarStatus('Falha');
        $this->appendNota($mensagem);
    }
}
