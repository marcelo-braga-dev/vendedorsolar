<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentosHistoricos extends Model
{
    use HasFactory;

    protected $fillable = [
        'orcamentos_id',
        'status',
        'mensagem'
    ];

    public function criar($id, $status, $msg = null)
    {
        $this->newQuery()
            ->create([
                'orcamentos_id' => $id,
                'status' => $status,
                'mensagem' => $msg,
            ]);
    }

    /**
     * Renomeado de statusExist() — o nome anterior dizia o contrário do que o
     * método fazia (retornava true quando o status NÃO existia no histórico),
     * o que já causou leitura equivocada da regra de negócio em Aprovado.php.
     */
    public function statusNaoExiste($id, $status): bool
    {
        return !$this->newQuery()
            ->where('orcamentos_id', $id)
            ->where('status', $status)
            ->exists();
    }
}
