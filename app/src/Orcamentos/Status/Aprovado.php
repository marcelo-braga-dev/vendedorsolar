<?php

namespace App\src\Orcamentos\Status;

class Aprovado implements Status
{
    private $status = 'aprovado';

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getNome(): string
    {
        return 'Aprovado';
    }
}
