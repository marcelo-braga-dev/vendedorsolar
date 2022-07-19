<?php
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
