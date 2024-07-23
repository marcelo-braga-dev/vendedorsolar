<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesMetas extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'meta',
        'value',
    ];

    public function values($id)
    {
        $dados = $this->newQuery()
            ->where('cliente_id', '=', $id)
            ->get();

        $resposta = [];

        foreach ($dados as $dado) {
            $resposta[$dado->meta] = $dado->value;
        }

        return $resposta;
    }

    public function insert($id, $dados)
    {
        foreach ($dados as $index => $item) {
            $this->newQuery()
                ->updateOrInsert(
                    ['cliente_id' => $id, 'meta' => $index], ['value' => $item]
                );
        }
    }
}
