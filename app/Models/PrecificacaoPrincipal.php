<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecificacaoPrincipal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'potencia',
        'margem'
    ];

    public function padrao()
    {
        return $this->newQuery()
            ->where('nome', '=', 'padrao')
            ->orderBy('potencia', 'ASC')
            ->get(['id', 'potencia', 'margem', 'updated_at']);
    }

    public function cadastrar($dados)
    {
        $this->newQuery()
            ->updateOrCreate(
                ['nome' => 'padrao', 'potencia' => $dados->potencia],
                ['margem' => $dados->margem]
            );
    }
}
