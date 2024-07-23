<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegracaoAldo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'categoria',
        'aldo',
        'potencia',
        'id_referencia'
    ];

    public function chaves()
    {
        $chave['chave'] = '';
        $chave['codigo'] = '';

        $dados = $this->newQuery()
            ->where('categoria', '=', 'chaves_integracao')
            ->get(['aldo', 'id_referencia']);

        foreach ($dados as $item) {
            $chave[$item->aldo] = $item->id_referencia;
        }

        return [
            'chave' => $chave['chave'],
            'codigo' => $chave['codigo']
        ];
    }
}
