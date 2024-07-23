<?php

if (!function_exists('getStatusBool')) {
    function getStatusBool($id = ''): string
    {
        switch ($id) {
            case '0' :
                return 'Desativado';
            case '1' :
                return 'Ativo';
            default :
                return 'Inválido';
        }
    }
}
if (!function_exists('getStatusOrcamentos')) {
    function getStatusOrcamentos($status)
    {
        $todosStatus = (new \App\src\Orcamentos\Status\StatusOrcamentos())->todosStatus();
        return $todosStatus[$status] ?? 'Não encontrado';
    }
}

if (!function_exists('getStatusCliente')) {
    function getStatusCliente($status)
    {
        $todosStatus = (new \App\src\Clientes\Status\StatusClientes())->todosStatus();
        return $todosStatus[$status] ?? 'Não encontrado';
    }
}

if (!function_exists('getStatusLead')) {
    function getStatusLead($status)
    {
        $todosStatus = (new \App\src\Clientes\Leads\Status\StatusLeads())->todosStatus();
        return $todosStatus[$status] ?? 'Não encontrado';
    }
}

if (!function_exists('getStatusVisitaTecnica')) {
    function getStatusVisitaTecnica($status)
    {
        $todosStatus = (new \App\src\VisitasTecnicas\Status\VisitasTecnicasStatus())->todosStatus();
        return $todosStatus[$status] ?? 'Não encontrado';
    }
}
