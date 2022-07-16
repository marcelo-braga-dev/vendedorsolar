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

    public function statusExist($id, $status)
    {
        return !$this->newQuery()
            ->where('orcamentos_id', $id)
            ->where('status', $status)
            ->exists();
    }
}
