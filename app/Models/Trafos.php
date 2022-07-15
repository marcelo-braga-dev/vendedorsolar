<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trafos extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'modelo',
        'produtos_id',
        'potencia',
        'margem',
        'preco_cliente',
        'preco_fornecedor',
        'fornecedor',
        'status',
        'status_fornecedor',
        'observacoes'
    ];

    public function atualizarPrecoPeloSKU($sku, $precoFornecedor)
    {
        $trafo = $this->newQuery()->where('sku', $sku);

        if ($trafo->exists()) {
            $margem = $trafo->first('margem')->margem;
            $precoCliente = $precoFornecedor * (1 + $margem / 100);
            return $this->newQuery()
                ->where('sku', $sku)
                ->update([
                        'preco_fornecedor' => $precoFornecedor,
                        'preco_cliente' => $precoCliente,
                        'status_fornecedor' => 1
                    ]
                );
        }
    }
}
