<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoLojaResource extends JsonResource
{
    public function toArray($request)
    {
        $precoVenda = round($this->preco_fornecedor * (1 + ($this->margem / 100)), 2);

        return [
            'sku'                  => $this->sku,
            'nome'                 => $this->modelo,
            'potencia_kit_kwp'     => (float) $this->potencia_kit,
            'tensao'               => $this->tensao,
            'preco_custo'          => (float) $this->preco_fornecedor,
            'preco_venda'          => $precoVenda,
            'disponivel'           => (bool) $this->status && (bool) $this->status_fornecedor,
            'marca_inversor'       => $this->marcaInversorRel?->nome,
            'marca_inversor_logo'  => $this->urlImagem($this->marcaInversorRel?->img_logo),
            'marca_inversor_imagem' => $this->urlImagem($this->marcaInversorRel?->img_produto),
            'potencia_inversor'    => $this->potencia_inversor,
            'marca_painel'         => $this->marcaPainelRel?->nome,
            'marca_painel_logo'    => $this->urlImagem($this->marcaPainelRel?->img_logo),
            'marca_painel_imagem'  => $this->urlImagem($this->marcaPainelRel?->img_produto),
            'potencia_painel'      => $this->potencia_painel,
            'estrutura'            => $this->estruturaRel?->nome,
            'categoria'            => $this->categoria,
            'imagens'              => $this->imagens->map(fn ($imagem) => [
                'url'       => $imagem->url,
                'principal' => (bool) $imagem->principal,
            ])->values(),
            'fornecedor'           => $this->fornecedorRel?->nome,
            'componentes'          => $this->produtos,
            'observacoes'          => $this->observacoes,
            'atualizado_em'        => optional($this->updated_at)->toIso8601String(),
        ];
    }

    private function urlImagem(?string $path): ?string
    {
        return $path ? asset('storage/' . $path) : null;
    }
}
