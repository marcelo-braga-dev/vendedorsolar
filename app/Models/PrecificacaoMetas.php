<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecificacaoMetas extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta',
        'meta_key',
        'value'
    ];

    public function getDados(string $chave)
    {
        return $this->newQuery()->where('meta', $chave)->get();
    }

    public function getVendedor($id)
    {
        return $this->newQuery()
                ->where('meta', '=', 'vendedor')
                ->where('meta_key', '=', $id)
                ->first(['meta_key', 'value'])->value ?? null;
    }

    public function getEstrutura($id)
    {
        return $this->newQuery()
                ->where('meta', '=', 'estrutura')
                ->where('meta_key', '=', $id)
                ->first(['meta_key', 'value'])->value ?? null;
    }

    public function getFornecedor($id)
    {
        return $this->newQuery()
                ->where('meta', '=', 'fornecedor')
                ->where('meta_key', '=', $id)
                ->first(['meta_key', 'value'])->value ?? null;
    }

    public function deletar($id)
    {
        $this->newQuery()->findOrFail($id) ->delete();
    }

    public function getEstado($estado): ?float
    {
        return $this->newQuery()
                ->where('meta', '=', 'estados')
                ->where('meta_key', '=', $estado)
                ->first(['meta_key', 'value'])->value ?? null;
    }

    public function getEstados(): array
    {
        $items = $this->newQuery()
            ->where('meta', '=', 'estados')
            ->get(['meta_key', 'value']);

        $margens = [];
        foreach ($items as $item) {
            $margens[$item->meta_key] = $item->value;
        }
        return $margens;
    }

    public function criar($meta, $key, $valor)
    {
        $this->newQuery()
            ->updateOrCreate(
                ['meta' => $meta, 'meta_key' => $key],
                ['value' => $valor]
            );
    }
}
