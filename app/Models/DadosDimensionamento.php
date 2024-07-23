<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosDimensionamento extends Model
{
    use HasFactory;

    public string $margemPerda = 'margem_perda';
    public string $sobraPotencia = 'sobra_potencia';
    public string $perdaNordesteNoroeste = 'nordeste_noroeste';
    public string $perdaLesteOeste = 'leste_oeste';
    public string $perdaSudesteSudoeste = 'sudeste_sudoeste';
    public string $perdaSul = 'sul';
    public string $orientacaoInstalacao = 'orientacao_instalacao';
    public string $ajusteCalculo = 'ajuste_calculo';

    protected $fillable = [
        'meta_key',
        'meta',
        'name',
        'value'
    ];

    public function getMargemPerda()
    {
        return $this->newQuery()
                ->where('meta', '=', $this->ajusteCalculo)
                ->where('meta_key', '=', $this->margemPerda)
                ->first()
                ->value ?? '';
    }

    public function setMargemPerda($margemPerda): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->ajusteCalculo, 'meta_key' => $this->margemPerda],
                ['value' => $margemPerda]
            );
    }

    public function getSobraPotencia()
    {
        return $this->newQuery()
                ->where('meta', '=', $this->ajusteCalculo)
                ->where('meta_key', '=', $this->sobraPotencia)
                ->first()
                ->value ?? '';
    }

    public function setSobraPotencia($sobraPotencia): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->ajusteCalculo, 'meta_key' => $this->sobraPotencia],
                ['value' => $sobraPotencia]
            );
    }

    public function getPerdaNordesteNoroeste(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaNordesteNoroeste)
                ->first()
                ->value ?? '';
    }

    public function setPerdaNordesteNoroeste($perdaNordesteNoroeste): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaNordesteNoroeste],
                ['name' => 'Nordeste/Noroeste', 'value' => $perdaNordesteNoroeste]
            );
    }

    public function getPerdaLesteOeste(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaLesteOeste)
                ->first()
                ->value ?? '';
    }

    public function setPerdaLesteOeste($perdaLesteOeste): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaLesteOeste],
                ['name' => 'Leste/Oeste', 'value' => $perdaLesteOeste]
            );
    }

    public function getPerdaSudesteSudoeste(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaSudesteSudoeste)
                ->first()
                ->value ?? '';
    }

    public function setPerdaSudesteSudoeste($perdaSudesteSudoeste): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaSudesteSudoeste],
                ['name' => 'Sudeste/Sudoeste', 'value' => $perdaSudesteSudoeste]
            );
    }

    public function getPerdaSul(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaSul)
                ->first()
                ->value ?? '';
    }

    public function setPerdaSul($perdaSul): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaSul],
                ['name' => 'Sul', 'value' => $perdaSul]
            );
    }

    public function getOrientacoes()
    {
        return $this->newQuery()
            ->where('meta', '=', $this->orientacaoInstalacao)
            ->get(['meta_key', 'name']);
    }

}
