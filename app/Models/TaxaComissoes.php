<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxaComissoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'taxa'
    ];

    public function criar()
    {
        $this->newQuery()
            ->create([
                'user_id' => 35,
                'taxa' => 66
            ]);
    }

    public function getTaxas($id)
    {
        $res = $this->newQuery()
            ->where('user_id', '=', $id)
            ->first('taxa');

        return $res->taxa ?? null;
    }
}
