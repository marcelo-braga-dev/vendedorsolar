<?php

namespace App\Http\Controllers\Admin\Integracoes\Edeltec;

use App\Models\Fornecedores;
use App\Models\Integracao\Edeltec\IntegracaoEdeltecHistorico;
use App\Models\IntegracaoEdeltec;
use App\Models\Kits;
use App\Services\IntegracoesDistribuidoras\Edeltec\Integracoes;
use App\Services\IntegracoesDistribuidoras\Edeltec\KitOnGrid;
use App\Services\IntegracoesDistribuidoras\Edeltec\Requisicao;
use App\src\Produtos\CalculoPrecos\MargensPadrao;
use Illuminate\Support\Facades\Log;

class EdeltecIntegracao
{
    public IntegracaoEdeltecHistorico $historico;

    public function init(): void
    {
        // Impede execuções simultâneas (scheduler + botão admin ao mesmo tempo)
        if ($this->jaEmExecucao()) {
            Log::info('Edeltec: integração já em andamento, execução ignorada.');
            return;
        }

        $this->createHistorico();

        // Garante margens frescas a cada execução
        MargensPadrao::limparCache();

        // ── Autenticação ──────────────────────────────────────────────────────
        $this->salvarStatus('Autenticando');

        $token = (new Integracoes())->autenticar();

        if (empty($token)) {
            $this->fail('Falha na autenticação: token não retornado pela API.');
            return;
        }

        // ── Mapa de índices (marcas, estruturas, fornecedor) ──────────────────
        $integracaoDados = (new IntegracaoEdeltec())->dados();

        if ($integracaoDados->isEmpty()) {
            $this->fail('Dados de integração não configurados na tabela integracao_edeltecs.');
            return;
        }

        // ── Busca e persistência paginada ─────────────────────────────────────
        $this->salvarStatus('Buscando Produtos');

        $req  = new Requisicao();
        $page = 1;

        // Mapa associativo garante unicidade em O(1), sem array_unique ao final
        $skuAtivos = [];
        $notas     = [];

        while (true) {
            try {
                $resposta = $req->getProdutos($token, $page);
            } catch (\RuntimeException $e) {
                $notas[] = $e->getMessage();
                Log::error('Edeltec: falha ao buscar página', ['page' => $page, 'erro' => $e->getMessage()]);
                break;
            }

            $items      = $resposta['items'] ?? [];
            $totalPages = (int) ($resposta['meta']['totalPages'] ?? 0);

            if (!is_array($items)) {
                $items = [];
            }

            $this->salvarStatus(
                'Processando página ' . $page . ($totalPages > 0 ? " de {$totalPages}" : '')
            );

            $lote = [];

            foreach ($items as $produto) {
                $sku = $produto['codProd'] ?? null;

                if (empty($sku)) {
                    continue;
                }

                try {
                    $lote[]           = (new KitOnGrid($produto, $integracaoDados))->toDataArray();
                    $skuAtivos[$sku]  = true; // só marca ativo se processado com sucesso
                } catch (\DomainException $e) {
                    $notas[] = "SKU {$sku}: " . $e->getMessage();
                    Log::warning('Edeltec integração (DomainException)', [
                        'sku' => $sku,
                        'msg' => $e->getMessage(),
                    ]);
                } catch (\Throwable $e) {
                    $notas[] = "SKU {$sku}: erro inesperado — " . $e->getMessage();
                    Log::error('Edeltec integração (Throwable)', [
                        'sku'       => $sku,
                        'exception' => $e,
                    ]);
                }
            }

            (new Kits())->bulkUpsert($lote);

            if ($totalPages > 0 && $page >= $totalPages) {
                break;
            }

            if ($totalPages === 0 && empty($items)) {
                break;
            }

            $page++;
        }

        // ── Consolida SKUs e notas ────────────────────────────────────────────
        $skusImportados = array_keys($skuAtivos);

        $this->historico->produtos_importados = $skusImportados;
        $this->historico->qtd_importados      = count($skusImportados);
        $this->historico->anotacoes           = implode(PHP_EOL, $notas) ?: null;
        $this->historico->save();

        // ── Desativa produtos ausentes na importação ──────────────────────────
        $idFornecedor = Fornecedores::query()
            ->where('nome', 'EDELTEC')
            ->value('id');

        if (empty($idFornecedor)) {
            $this->fail('Fornecedor "EDELTEC" não encontrado na tabela fornecedores.');
            return;
        }

        // Reutiliza a mesma condição para pluck e update, evitando
        // um whereIn com lista potencialmente enorme na query de atualização
        $queryDesativar = fn () => Kits::query()
            ->where('fornecedor', $idFornecedor)
            ->when(!empty($skusImportados), fn ($q) => $q->whereNotIn('sku', $skusImportados));

        $skuDesativar = $queryDesativar()->pluck('sku')->toArray();

        if (!empty($skuDesativar)) {
            $queryDesativar()->update([
                'status'            => 0,
                'status_fornecedor' => 0,
            ]);
        }

        $this->historico->qtd_desativados      = count($skuDesativar);
        $this->historico->produtos_desativados = $skuDesativar;
        $this->historico->save();

        $this->complete('Concluído');
    }

    private function jaEmExecucao(): bool
    {
        return IntegracaoEdeltecHistorico::query()
            ->whereNull('data_fim')
            ->whereNotIn('status', ['Concluído', 'Falha'])
            ->where('data_inicio', '>=', now()->subHours(2))
            ->exists();
    }

    private function createHistorico(): void
    {
        $this->historico = IntegracaoEdeltecHistorico::create([
            'data_inicio' => now(),
            'status'      => 'Iniciando',
        ]);
    }

    private function salvarStatus(string $status): void
    {
        $this->historico->status = $status;
        $this->historico->save();
    }

    private function complete(string $status): void
    {
        $this->historico->status   = $status;
        $this->historico->data_fim = now();
        $this->historico->save();
    }

    private function fail(string $mensagem): void
    {
        $atual = (string) ($this->historico->anotacoes ?? '');

        $this->historico->status    = 'Falha';
        $this->historico->data_fim  = now();
        $this->historico->anotacoes = trim($atual . ($atual !== '' ? PHP_EOL : '') . $mensagem);
        $this->historico->save();

        Log::error('Edeltec integração falhou', ['mensagem' => $mensagem]);
    }
}
