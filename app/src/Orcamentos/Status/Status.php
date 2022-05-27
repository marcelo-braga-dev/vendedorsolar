<?php

namespace App\src\Orcamentos\Status;

interface Status
{
    public function getStatus(): string;
    public function getNome(): string;
}
