<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Admin\Integracoes\Edeltec\EdeltecIntegracao;
use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\Integracao\Edeltec\IntegracaoEdeltecHistorico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EldeltecController extends Controller
{
    public function index(Request $request)
    {
        // ── Fornecedor Edeltec ─────────────────────────────────────────────
        $fornecedor   = Fornecedores::query()->where('nome', 'EDELTEC')->first();
        $idFornecedor = $fornecedor?->id;

        // ── KPIs do catálogo ──────────────────────────────────────────────
        $totalAtivos   = 0;
        $totalInativos = 0;
        $distribuicaoPotencia        = [];
        $distribuicaoMarcaInversor   = [];
        $distribuicaoMarcaPainel     = [];
        $distribuicaoEstrutura       = [];

        if ($idFornecedor) {
            $totalAtivos = DB::table('kits')
                ->where('fornecedor', $idFornecedor)->where('status', 1)->count();

            $totalInativos = DB::table('kits')
                ->where('fornecedor', $idFornecedor)->where('status', 0)->count();

            // Distribuição por faixa de potência
            $potRows = DB::table('kits')
                ->selectRaw('potencia_kit, COUNT(*) as total')
                ->where('fornecedor', $idFornecedor)->where('status', 1)
                ->groupBy('potencia_kit')->orderBy('potencia_kit')->get();

            foreach ($potRows as $r) {
                $faixa = $this->faixaPotencia((float) $r->potencia_kit);
                $distribuicaoPotencia[$faixa] = ($distribuicaoPotencia[$faixa] ?? 0) + (int) $r->total;
            }
            ksort($distribuicaoPotencia);

            // Distribuição por marca inversor
            $marcasInv = DB::table('kits')
                ->leftJoin('produtos_marcas', 'produtos_marcas.id', '=', 'kits.marca_inversor')
                ->selectRaw('COALESCE(produtos_marcas.nome, "Desconhecida") as nome, COUNT(*) as total')
                ->where('kits.fornecedor', $idFornecedor)->where('kits.status', 1)
                ->groupBy('produtos_marcas.nome')->orderByDesc('total')->limit(8)->get();

            foreach ($marcasInv as $r) {
                $distribuicaoMarcaInversor[$r->nome] = (int) $r->total;
            }

            // Distribuição por marca painel
            $marcasPnl = DB::table('kits')
                ->leftJoin('produtos_marcas', 'produtos_marcas.id', '=', 'kits.marca_painel')
                ->selectRaw('COALESCE(produtos_marcas.nome, "Desconhecida") as nome, COUNT(*) as total')
                ->where('kits.fornecedor', $idFornecedor)->where('kits.status', 1)
                ->groupBy('produtos_marcas.nome')->orderByDesc('total')->limit(8)->get();

            foreach ($marcasPnl as $r) {
                $distribuicaoMarcaPainel[$r->nome] = (int) $r->total;
            }

            // Distribuição por estrutura
            $estruturasRows = DB::table('kits')
                ->leftJoin('estruturas', 'estruturas.id', '=', 'kits.estrutura')
                ->selectRaw('COALESCE(estruturas.nome, "Sem tipo") as nome, COUNT(*) as total')
                ->where('kits.fornecedor', $idFornecedor)->where('kits.status', 1)
                ->groupBy('estruturas.nome')->orderByDesc('total')->get();

            foreach ($estruturasRows as $r) {
                $distribuicaoEstrutura[$r->nome] = (int) $r->total;
            }
        }

        // ── Histórico paginado ────────────────────────────────────────────
        $historicos = IntegracaoEdeltecHistorico::query()
            ->orderByDesc('id')
            ->paginate(20);

        $historicos->getCollection()->transform(fn($h) => $this->formatarHistorico($h));

        // ── Última sincronização ──────────────────────────────────────────
        $ultimaSync = IntegracaoEdeltecHistorico::query()->orderByDesc('id')->first();
        if ($ultimaSync) {
            $ultimaSync = $this->formatarHistorico($ultimaSync);
        }

        // ── KPIs de sincronizações ────────────────────────────────────────
        $totalSyncs    = IntegracaoEdeltecHistorico::query()->count();
        $totalSucessos = IntegracaoEdeltecHistorico::query()->where('status', 'Concluído')->count();
        $totalFalhas   = IntegracaoEdeltecHistorico::query()->where('status', 'Falha')->count();
        $taxaSucesso   = $totalSyncs > 0 ? round($totalSucessos / $totalSyncs * 100) : 0;

        $mediaImportados = $totalSucessos > 0
            ? (int) round(
                IntegracaoEdeltecHistorico::query()
                    ->where('status', 'Concluído')
                    ->avg('qtd_importados') ?? 0
              )
            : 0;

        // ── Gráfico histórico (últimas 20 execuções) ──────────────────────
        $graficoHistorico = IntegracaoEdeltecHistorico::query()
            ->orderByDesc('id')
            ->limit(20)
            ->get()
            ->reverse()
            ->values()
            ->map(fn($h) => [
                'label'       => optional($h->data_inicio)->format('d/m H:i') ?? '#'.$h->id,
                'importados'  => (int) ($h->qtd_importados ?? 0),
                'desativados' => (int) ($h->qtd_desativados ?? 0),
                'sucesso'     => str_contains(strtolower((string) $h->status), 'conclu'),
            ]);

        // ── Logs de erros / anotações ─────────────────────────────────────
        $logsErros = IntegracaoEdeltecHistorico::query()
            ->whereNotNull('anotacoes')
            ->where('anotacoes', '!=', '')
            ->orderByDesc('id')
            ->limit(100)
            ->get()
            ->map(fn($h) => [
                'id'        => $h->id,
                'data'      => optional($h->data_inicio)->format('d/m/Y H:i'),
                'status'    => $h->status,
                'linhas'    => array_values(array_filter(explode("\n", trim($h->anotacoes ?? '')))),
                'total_err' => substr_count($h->anotacoes ?? '', "\n") + 1,
            ]);

        $totalLinhasErro = $logsErros->sum('total_err');

        // ── Catálogo de produtos (com filtros) ────────────────────────────
        $searchProduto = $request->string('q')->toString();
        $filtroPotMin  = $request->input('pot_min');
        $filtroPotMax  = $request->input('pot_max');
        $filtroStatus  = $request->input('st', 'ativos');

        $produtosQuery = DB::table('kits')
            ->leftJoin('produtos_marcas as pm_inv', 'pm_inv.id', '=', 'kits.marca_inversor')
            ->leftJoin('produtos_marcas as pm_pnl', 'pm_pnl.id', '=', 'kits.marca_painel')
            ->leftJoin('estruturas', 'estruturas.id', '=', 'kits.estrutura')
            ->select([
                'kits.id', 'kits.sku', 'kits.modelo', 'kits.potencia_kit',
                'kits.preco_fornecedor', 'kits.status', 'kits.status_fornecedor',
                'kits.tensao', 'kits.potencia_inversor', 'kits.potencia_painel',
                'kits.updated_at',
                'pm_inv.nome as marca_inversor_nome',
                'pm_pnl.nome as marca_painel_nome',
                'estruturas.nome as estrutura_nome',
            ]);

        if ($idFornecedor) {
            $produtosQuery->where('kits.fornecedor', $idFornecedor);
        }

        $filtroStatus === 'inativos'
            ? $produtosQuery->where('kits.status', 0)
            : $produtosQuery->where('kits.status', 1);

        if ($searchProduto) {
            $produtosQuery->where(function ($q) use ($searchProduto) {
                $q->where('kits.sku', 'like', "%{$searchProduto}%")
                  ->orWhere('kits.modelo', 'like', "%{$searchProduto}%")
                  ->orWhere('pm_inv.nome', 'like', "%{$searchProduto}%")
                  ->orWhere('pm_pnl.nome', 'like', "%{$searchProduto}%");
            });
        }

        if ($filtroPotMin !== null && $filtroPotMin !== '') {
            $produtosQuery->where('kits.potencia_kit', '>=', (float) $filtroPotMin);
        }
        if ($filtroPotMax !== null && $filtroPotMax !== '') {
            $produtosQuery->where('kits.potencia_kit', '<=', (float) $filtroPotMax);
        }

        $produtos = $produtosQuery
            ->orderBy('kits.potencia_kit')
            ->paginate(25, ['*'], 'pg_prod')
            ->appends($request->query());

        return view('pages.admin.integracoes.eldeltec.index', compact(
            'historicos', 'ultimaSync', 'totalAtivos', 'totalInativos',
            'totalSyncs', 'totalSucessos', 'totalFalhas', 'taxaSucesso',
            'mediaImportados', 'graficoHistorico', 'logsErros', 'totalLinhasErro',
            'produtos', 'distribuicaoPotencia', 'distribuicaoMarcaInversor',
            'distribuicaoMarcaPainel', 'distribuicaoEstrutura',
            'searchProduto', 'filtroPotMin', 'filtroPotMax', 'filtroStatus',
            'fornecedor',
        ));
    }

    public function integrar()
    {
        // Permite execução longa sem ser interrompido pelo timeout do PHP
        set_time_limit(0);

        (new EdeltecIntegracao())->init();
        modalSucesso('Integração realizada com sucesso!');
        return redirect()->route('admin.integracoes.eldeltec.index');
    }

    // ── Helpers ───────────────────────────────────────────────────────────

    private function formatarHistorico($h)
    {
        $importados = is_array($h->produtos_importados)
            ? $h->produtos_importados
            : (array) json_decode($h->produtos_importados ?? '[]', true);

        $desativados = is_array($h->produtos_desativados)
            ? $h->produtos_desativados
            : (array) json_decode($h->produtos_desativados ?? '[]', true);

        $h->importados      = $importados;
        $h->desativados     = $desativados;
        $h->qtd_importados  = $h->qtd_importados ?? count($importados);
        $h->qtd_desativados = $h->qtd_desativados ?? count($desativados);
        $h->data_inicio_fmt = optional($h->data_inicio)->format('d/m/Y H:i:s');
        $h->data_fim_fmt    = optional($h->data_fim ?? $h->updated_at)->format('d/m/Y H:i:s');

        if ($h->data_inicio) {
            $inicio   = Carbon::parse($h->data_inicio);
            $fim      = Carbon::parse($h->data_fim ?? $h->updated_at);
            $segundos = max(0, $inicio->diffInSeconds($fim));
            $min      = (int) floor($segundos / 60);
            $sec      = (int) ($segundos % 60);

            $h->duracao_fmt = $segundos < 60
                ? "{$sec}s"
                : ($segundos < 3600
                    ? "{$min}min" . ($sec > 0 ? " {$sec}s" : '')
                    : floor($min / 60) . "h " . ($min % 60) . "min");
        } else {
            $h->duracao_fmt = '—';
        }

        $s = strtolower((string) $h->status);
        $h->badge_class = str_contains($s, 'falh') ? 'badge-err'
            : (str_contains($s, 'conclu') ? 'badge-ok' : 'badge-warn');

        return $h;
    }

    private function faixaPotencia(float $kw): string
    {
        if ($kw <= 5)  return 'Até 5 kWp';
        if ($kw <= 10) return '5–10 kWp';
        if ($kw <= 20) return '10–20 kWp';
        if ($kw <= 30) return '20–30 kWp';
        if ($kw <= 50) return '30–50 kWp';
        if ($kw <= 75) return '50–75 kWp';
        return 'Acima 75 kWp';
    }
}
