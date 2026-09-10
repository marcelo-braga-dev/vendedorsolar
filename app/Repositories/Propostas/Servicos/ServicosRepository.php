<?php

namespace App\Repositories\Propostas\Servicos;

use App\Models\PropostaServico;

class ServicosRepository
{
    public function create(array $data): int
    {
        $proposta = (new PropostaServico())->create([
            'consultor_id' => id_usuario_atual(),
            'cliente_id' => $data['cliente_id'],
            'valor' => $data['preco_proposta'],
            'prazo_final' => $data['prazo_final'] ?? null,
            'titulo' => $data['titulo'] ?? null,
            'descricao' => $data['descricao'] ?? null,
        ]);

        return $proposta->id;
    }

    public function all(?string $busca = null, int $perPage = 30)
    {
        return (new PropostaServico())
            ->when($busca, function ($query) use ($busca) {
                $query->where(function ($sub) use ($busca) {
                    $sub->where('titulo', 'like', "%{$busca}%")
                        ->orWhereHas('cliente', function ($c) use ($busca) {
                            $c->where('nome', 'like', "%{$busca}%")
                                ->orWhere('razao_social', 'like', "%{$busca}%");
                        })
                        ->orWhereHas('vendedor', function ($v) use ($busca) {
                            $v->where('name', 'like', "%{$busca}%");
                        });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function allVendedor()
    {
        return (new PropostaServico())
            ->where('consultor_id', id_usuario_atual())
            ->orderBy('id', 'desc')
            ->get();
    }

    public function find(int $id): ?PropostaServico
    {
        return (new PropostaServico())
            ->find($id);
    }
}
