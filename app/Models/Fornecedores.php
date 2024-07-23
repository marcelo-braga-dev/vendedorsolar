<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable =
        [
            'nome',
            'margem',
            'observacoes'
        ];

    public function fornecedores(): array
    {
        $dados = $this->newQuery()->orderBy('nome')->get();

        $items = [];
        foreach ($dados as $item) {
            $items[$item->id] = $item;
        }
        return $items;
    }

    public function cadastrar($dados)
    {
        $this->dados($dados, $this);
    }

    private function dados($request, $instancia)
    {
        $instancia->nome = $request->nome;
        $instancia->cnpj = $request->cnpj;
        $instancia->celular = $request->celular;
        $instancia->representante = $request->representante;
        $instancia->email = $request->email;
        $instancia->telefone = $request->telefone;
        $instancia->site = $request->site;
        $instancia->anotacoes = $request->anotacoes;
        $instancia->push();
    }

    public function atualizar($dados, $id)
    {
        $fornecedor = $this->newQuery()->find($id);
        $this->dados($dados, $fornecedor);
    }
}
