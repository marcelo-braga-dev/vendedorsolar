<?php

namespace App\Http\Controllers\Admin\Integracoes\Edeltec;

use App\Models\Fornecedores;
use App\Models\Integracao\Edeltec\IntegracaoEdeltecHistorico;
use App\Models\IntegracaoEdeltec;
use App\Models\KitImagem;
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

        try {
            $this->executar();
        } catch (\Throwable $e) {
            // Garante que toda falha não tratada feche o histórico (status + data_fim).
            // Sem isso, um registro travado em status "Processando" bloqueia novas
            // execuções por até 2h (ver jaEmExecucao()), deixando a integração
            // inoperante até alguém corrigir manualmente no banco.
            Log::error('Edeltec integração: erro não tratado', ['exception' => $e]);
            $this->fail('Erro inesperado: ' . $e->getMessage());
        }
    }

    private function executar(): void
    {
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

            $lote          = [];
            $imagensPorSku = [];

            foreach ($items as $produto) {
                $sku = $produto['codProd'] ?? null;

                if (empty($sku)) {
                    continue;
                }

                try {
                    $kit                       = new KitOnGrid($produto, $integracaoDados);
                    $lote[]                    = $kit->toDataArray();
                    $imagensPorSku[(string) $sku] = $kit->getImagens();
                    $skuAtivos[$sku]           = true; // só marca ativo se processado com sucesso
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
            $this->sincronizarImagens($imagensPorSku);

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
        $this->historico->anotacoes           = $this->truncarNotas($notas);
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

    /**
     * Soma ao álbum de cada kit da página atual as imagens recebidas da Edeltec
     * (sem remover as que já existiam) e atualiza a capa do produto para a
     * primeira imagem fornecida pela distribuidora nesta rodada.
     */
    private function sincronizarImagens(array $imagensPorSku): void
    {
        if (empty($imagensPorSku)) {
            return;
        }

        $idsPorSku = Kits::query()
            ->whereIn('sku', array_keys($imagensPorSku))
            ->pluck('id', 'sku');

        $imagensPorKitId = [];

        foreach ($imagensPorSku as $sku => $imagens) {
            $kitId = $idsPorSku[$sku] ?? null;

            if (!$kitId || empty($imagens)) {
                continue;
            }

            $imagensPorKitId[$kitId] = $imagens;
        }

        (new KitImagem())->adicionarAoAlbum($imagensPorKitId);
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
        $this->historico->anotacoes = $this->limitarTamanho(trim($atual . ($atual !== '' ? PHP_EOL : '') . $mensagem));
        $this->historico->save();

        Log::error('Edeltec integração falhou', ['mensagem' => $mensagem]);
    }

    /**
     * Junta as notas em texto, limitando o tamanho para não exceder a coluna TEXT
     * (65.535 bytes no MySQL) — sem isso, um excesso de SKUs com erro (ex.: marca
     * nova ainda não mapeada) derruba o save() do histórico com QueryException.
     */
    private function truncarNotas(array $notas): ?string
    {
        if (empty($notas)) {
            return null;
        }

        return $this->limitarTamanho(implode(PHP_EOL, $notas), count($notas));
    }

    private function limitarTamanho(string $texto, ?int $totalLinhas = null): string
    {
        $limite = 60000;

        if (mb_strlen($texto) <= $limite) {
            return $texto;
        }

        $resumo = $totalLinhas
            ? "... ({$totalLinhas} avisos no total; truncado por limite de tamanho da coluna)"
            : '... (truncado por limite de tamanho da coluna)';

        return mb_substr($texto, 0, $limite) . PHP_EOL . $resumo;
    }
}
