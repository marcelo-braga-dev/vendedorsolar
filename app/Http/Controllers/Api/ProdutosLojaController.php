<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoLojaResource;
use App\Models\Fornecedores;
use App\Models\Kits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProdutosLojaController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'atualizados_desde' => 'sometimes|date',
            'per_page'          => 'sometimes|integer|min:1|max:200',
        ]);

        $perPage = (int) $request->input('per_page', 50);

        $query = $this->baseQuery();

        if ($request->filled('atualizados_desde')) {
            $query->where('updated_at', '>=', $request->date('atualizados_desde'));
        }

        $produtos = $query->orderBy('id')->paginate($perPage);

        return ProdutoLojaResource::collection($produtos);
    }

    public function show(string $sku)
    {
        $produto = $this->baseQuery()
            ->where('sku', $sku)
            ->first();

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        return new ProdutoLojaResource($produto);
    }

    private function baseQuery()
    {
        return Kits::query()
            ->where('fornecedor', $this->idFornecedorEdeltec())
            ->where('status', 1)
            ->where('status_fornecedor', 1)
            ->whereNotNull('sku')
            ->where('sku', '!=', '')
            ->with(['marcaInversorRel', 'marcaPainelRel', 'estruturaRel', 'fornecedorRel', 'imagens']);
    }

    private function idFornecedorEdeltec(): int
    {
        return Cache::remember('fornecedor_edeltec_id', now()->addHour(), function () {
            return Fornecedores::query()->where('nome', 'EDELTEC')->value('id');
        });
    }
}
