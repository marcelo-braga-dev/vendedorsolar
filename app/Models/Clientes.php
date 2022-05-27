<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'users_id', 'cidades_estados_id'];

    public function cadastrar($request)
    {
        $cliente = $this->newQuery()
            ->create([
                'nome' => $request->nome,
                'users_id' => id_usuario_atual(),
                'cidades_estados_id' => $request->cidade
            ]);

        $dados = $this->getDados($request);

        $metas = new ClientesMetas();
        $metas->insert($cliente->id, $dados);

        modalSucesso('Cliente cadastrado com sucesso!');
    }

    public function atualizar($request, $id)
    {
        $this->newQuery()
            ->where('id', '=', $id)
            ->update([
                'nome' => $request->nome,
                'cidades_estados_id' => $request->cidade
            ]);

        $dados = $this->getDados($request);

        $metas = new ClientesMetas();
        $metas->insert($id, $dados);

        modalSucesso('Dados do cliente atualizado com sucesso!');
    }

    public function pesquisar($id)
    {
        return $this->newQuery()
            ->where([
                ['users_id', '=', id_usuario_atual()],
                ['id', '=', $id]
            ])->first();
    }

    private function getDados($request)
    {
        return $request->except(['_token', '_method', 'nome', 'users_id', 'cidades_estados_id', 'estado', 'cidade']);
    }
}
