<?php

namespace App\src\Contratos;

class Dados
{
    public function infoContrato(string $id)
    {
        $this->conectaTabela(self::DB_ORCAMENTOS);
        $resultado = $this->mysql->query("SELECT * FROM `contratos` WHERE `id` = '$id'");
        $resposta = $resultado->fetch_all(MYSQLI_ASSOC);

        return $resposta[0];
    }

    public function infoOrcamento(string $id)
    {
        $this->conectaTabela(self::DB_ORCAMENTOS);
        $resultado = $this->mysql->query("SELECT * FROM `orcamentos` WHERE `id` = '$id'");
        $resposta = $resultado->fetch_all(MYSQLI_ASSOC);

        return $resposta[0];
    }

    public function infoKit(string $id)
    {
        $this->conectaTabela(self::DB_PRODUTOS);
        $resultado = $this->mysql->query("SELECT * FROM `kits` WHERE `id` = '$id'");
        $resposta = $resultado->fetch_all(MYSQLI_ASSOC);

        return $resposta[0];
    }
}
