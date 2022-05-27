<?php

namespace App\src\Orcamentos\Dimensionamento;

class VariaveisCalculo
{
    public string $margemPerda;
    public string $sobraPotencia;
    public string $perdaNordesteNoroeste;
    public string $perdaLesteOeste;
    public string $perdaSudesteSudoeste;
    public string $perdaSul;

    public function __construct()
    {
        $this->margemPerda = '';
        $this->sobraPotencia = '';
        $this->perdaNordesteNoroeste = '';
        $this->perdaLesteOeste = '';
        $this->perdaSudesteSudoeste = '';
        $this->perdaSul = '';
    }

}
