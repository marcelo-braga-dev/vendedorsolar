<?php

namespace App\src\Orcamentos\Status;

class Assinado implements Status
{
    private string $status;

    public function __construct()
    {
        $this->status = 'aprovando';
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getNome(): string
    {
        return 'Para Aprovação';
    }
}
