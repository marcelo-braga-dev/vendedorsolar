<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosKits;
use App\Models\Produtos;
use App\Models\Trafos;
use App\Models\User;
use App\Models\UserMeta;
use App\Services\Orcamentos\ComissaoVendedorService;
use App\src\Orcamentos\Status\Aprovado;
use App\src\Orcamentos\Status\Assinado;
use App\src\Orcamentos\Status\Finalizado;
use App\src\Orcamentos\Status\Instalando;
use App\src\Orcamentos\Status\Novo;
use Illuminate\Http\Request;

class OrcamentosController extends Controller
{
    /**
     * Listagem com filtro por status (opcional).
     */
    public function index(Request $request)
    {
        // normaliza o status (aceita "instalando" ou "instalandos")
        $statusKey = $this->normalizeStatusKey($request->string('status')->toString());

        $statusValue = $this->statusMap()[$statusKey] ?? null;
        $label       = $this->labelMap()[$statusKey]  ?? 'Todos Orçamentos Gerados';

        $query = Orcamentos::query()
            ->when($statusValue, fn ($q) => $q->where('status', $statusValue))
            ->orderByDesc('created_at');

        $orcamentos = $query->paginate(30)->appends($request->query());

        // mapas id => nome
        $cliente  = Clientes::query()->pluck('nome', 'id');     // ['id' => 'nome']
        $vendedor = User::query()->pluck('name', 'id');         // ['id' => 'name']

        return view('pages.admin.orcamentos.index', compact('orcamentos', 'cliente', 'vendedor', 'label'));
    }

    /**
     * Detalhe do orçamento.
     */
    public function show(int $id)
    {
        $orcamento     = Orcamentos::query()->findOrFail($id);
        $trafo         = Trafos::query()->find($orcamento->trafo);
        $dadosCliente  = (new ClientesMetas())->values($orcamento->clientes_id);
        $imagens       = (new Produtos())->getDados();
        $dadosVendedor = (new UserMeta())->metas($orcamento->users_id);
        $metas         = (new OrcamentosInfos())->dado($orcamento->id);
        $orcamentoKit  = (new OrcamentosKits())->dado($orcamento->id);
        $kit           = Kits::query()->find($orcamentoKit->kits_id ?? null);

        $comissao = (new ComissaoVendedorService())->calcular($trafo, $orcamento, $kit, $orcamentoKit);

        return view('pages.admin.orcamentos.show', compact(
            'orcamento', 'kit', 'imagens', 'dadosCliente', 'dadosVendedor',
            'metas', 'orcamentoKit', 'comissao', 'trafo'
        ));
    }

    /**
     * Atualiza informações do orçamento e produtos do kit.
     */
    public function update(Request $request, int $id)
    {
        // validações básicas (ajuste conforme necessidade)
        $validated = $request->validate([
            'preco_cliente' => ['required', 'string'], // vem mascarado, convertemos abaixo
            'geracao'       => ['nullable', 'string'],
            'anotacoes'     => ['nullable', 'string'],
            'produtos'      => ['nullable', 'string'],
        ]);

        $orcamento = Orcamentos::query()->findOrFail($id);

        $orcamento->update([
            'preco_cliente' => convert_money_float($validated['preco_cliente']),
            'geracao'       => $validated['geracao'] ?? $orcamento->geracao,
            'anotacoes'     => $validated['anotacoes'] ?? $orcamento->anotacoes,
        ]);

        OrcamentosKits::query()
            ->where('orcamentos_id', $id)
            ->update([
                'produtos' => $validated['produtos'] ?? null,
            ]);

        modalSucesso('Informações atualizadas com sucesso.');

        // redireciona para a tela de edição (GET), não para a rota de update (PUT/PATCH)
        return redirect()->route('admin.orcamentos.edit', $id);
    }

    /**
     * Tela de edição do orçamento.
     */
    public function edit(int $id)
    {
        $orcamento = Orcamentos::query()->findOrFail($id);

        $orcamentoKit = OrcamentosKits::query()
            ->where('orcamentos_id', $id)
            ->first();

        $todosStatus = app(\App\src\Orcamentos\Status\StatusOrcamentos::class)->todosStatus();

        return view('pages.admin.orcamentos.edit', compact('orcamento', 'orcamentoKit', 'todosStatus'));
    }

    /* ====================== Helpers ====================== */

    /**
     * Normaliza a chave de status vinda da querystring.
     * Aceita "instalando" e "instalandos" como a mesma chave.
     */
    private function normalizeStatusKey(?string $status): ?string
    {
        if (!$status) return null;
        $status = strtolower(trim($status));

        return match ($status) {
            'instalando', 'instalandos' => 'instalando',
            default => $status,
        };
    }

    /**
     * Mapa de status (chave -> valor interno).
     */
    private function statusMap(): array
    {
        return [
            'novos'       => (new Novo())->getStatus(),
            'assinados'   => (new Assinado())->getStatus(),
            'aprovados'   => (new Aprovado())->getStatus(),
            'instalando'  => (new Instalando())->getStatus(),
            'finalizados' => (new Finalizado())->getStatus(),
        ];
    }

    /**
     * Mapa de labels para o título da página/lista.
     */
    private function labelMap(): array
    {
        return [
            'novos'       => 'Orçamentos Novos',
            'assinados'   => 'Orçamentos Assinados',
            'aprovados'   => 'Orçamentos Aprovados',
            'instalando'  => 'Sistemas Instalados',
            'finalizados' => 'Sistemas Finalizados',
        ];
    }
}
