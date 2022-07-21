<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable =
        [
            'tipo',
            'nome',
            'categoria',
            'img_logo',
            'img_produto',
            'garantia',
            'ref'
        ];

    public function inversores()
    {
        $marcas = $this->newQuery()
            ->where('tipo', '=', 'inversor')
            ->orderBy('nome')
            ->get();

        $items = [];
        foreach ($marcas as $item) {
            $items[$item->id] = $item;
        }
        return $items;
    }

    public function paineis()
    {
        $paineis = $this->newQuery()
            ->where('tipo', '=', 'painel')
            ->orderBy('nome')
            ->get();

        $painel = [];
        foreach ($paineis as $item) {
            $painel[$item->id] = $item;
        }
        return $painel;
    }

    public function trafos()
    {
        $marcas = $this->newQuery()
            ->where('tipo', '=', 'trafo')
            ->orderBy('nome')
            ->get();
        $items = [];
        foreach ($marcas as $item) {
            $items[$item->id] = $item;
        }
        return $items;
    }

    public function getDados()
    {
        $items = $this->newQuery()->get();
        $imagens = [];
        foreach ($items as $item) {
            $imagens[$item->id] = [
                'nome' => $item->nome,
                'logo' => $item->img_logo,
                'produto' => $item->img_produto,
                'garantia' => $item->garantia
            ];
        }
        return $imagens;
    }
}
