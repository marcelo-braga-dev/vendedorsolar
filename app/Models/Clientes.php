<?php

namespace App\Models;

use App\src\Clientes\Status\StatusClientesClasse;
use App\src\Clientes\Status\StatusNovoCliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'razao_social', 'users_id', 'cidades_estados_id', 'status'];

    protected $appends = ['dados'];

    public function metas()
    {
        return $this->hasMany(ClientesMetas::class, 'cliente_id', 'id');
    }

    public function getDadosAttribute()
    {
        // Garante que as metas estejam carregadas; se não, carrega
        $metas = $this->relationLoaded('metas') ? $this->metas : $this->metas()->get();

        // pluck('value','metas') => ['cnpj' => '...', 'cpf' => '...']
        $array = $metas->pluck('value', 'meta')->toArray();

        return (object) $array; // permite acessar como $cliente->dados->cnpj
    }

    //////

    public function cadastrar($request)
    {
        $status = (new StatusNovoCliente())->getStatus();
        $cliente = $this->newQuery()
            ->create([
                'nome' => $request->nome,
                'razao_social' => $request->razao_social,
                'users_id' => id_usuario_atual(),
                'cidades_estados_id' => $request->cidade,
                'status' => $status
            ]);

        $dados = $this->getDados($request);

        (new ClientesMetas())->insert($cliente->id, $dados);

        modalSucesso('Cliente cadastrado com sucesso!');
    }

    public function atualizar($request, $id)
    {
        $this->newQuery()
            ->where('id', '=', $id)
            ->update([
                'nome' => $request->nome,
                'razao_social' => $request->razao_social,
                'cidades_estados_id' => $request->cidade
            ]);

        $dados = $this->getDados($request);

        (new ClientesMetas())->insert($id, $dados);

        modalSucesso('Dados do cliente atualizado com sucesso!');
    }

    public function atualizarStatus(int $id, StatusClientesClasse $status)
    {
        $this->newQuery()
            ->where('id', $id)
            ->update([
                'status' => $status->getStatus()
            ]);
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
