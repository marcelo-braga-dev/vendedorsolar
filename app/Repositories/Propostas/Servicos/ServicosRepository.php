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

    public function all()
    {
        return (new PropostaServico())
            ->orderBy('id', 'desc')
            ->get();
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
