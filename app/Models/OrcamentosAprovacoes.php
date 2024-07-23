<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentosAprovacoes extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'orcamentos_id',
        'meta',
        'value',
    ];

    public function criar($id, $dados)
    {
        foreach ($dados as $index => $dado) {
            $this->newQuery()->updateOrInsert(
                ['orcamentos_id' => $id, 'meta' => $index],
                ['value' => $dado]
            );
        }
    }
}
