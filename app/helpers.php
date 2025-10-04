<?php

use App\Models\Clientes;
use App\Services\CidadesEstadosService;

require_once 'Helpers/status.php';
require_once 'Helpers/dimensionamento.php';
require_once 'Helpers/produtos.php';
require_once 'Helpers/config.php';

if (!function_exists('print_pre')) {
    function print_pre($arg)
    {
        echo '<pre>';
        print_r($arg);
        echo '</pre>';
        exit();
    }
}

if (!function_exists('convert_money_float')) {
    function convert_money_float($arg, $decimais = 2)
    {
        try {
            if (is_string($arg)) {
                $arg = str_replace('.', '', $arg);
                $arg = str_replace(',', '.', $arg);
                $arg = number_format($arg, $decimais, '.', '');
            }
        } catch (ErrorException $exception) {
            return 1;
        }

        return $arg;
    }
}

if (!function_exists('convert_float_money')) {
    function convert_float_money($arg, $decimais = 2)
    {
        if (is_numeric($arg)) {
            $arg = number_format($arg, $decimais, ',', '.');
        }
        return $arg;
    }
}

if (!function_exists('id_usuario_atual')) {
    function id_usuario_atual()
    {
        return auth()->user()->id;
    }
}

if (!function_exists('usuario')) {
    function usuario(int $id)
    {
        return (new \App\Models\User())->newQuery()->find($id);
    }
}

if (!function_exists('nomeUsuario')) {
    function nomeUsuario(?int $id)
    {
        return (new \App\Models\User())->newQuery()->find($id)->name ?? '';
    }
}

if (!function_exists('getCidades')) {
    function getCidades()
    {
        return CidadesEstadosService::getCidades();
    }
}

if (!function_exists('getEstados')) {
    function getEstados()
    {
        return CidadesEstadosService::getEstados();
    }
}

if (!function_exists('getCidadeEstado')) {
    function getCidadeEstado($id)
    {
        try {
            return (new CidadesEstadosService())->getCidadeEstado($id);
        } catch (TypeError $exception) {
        }
    }
}

if (!function_exists('getNomeCliente')) {
    function getNomeCliente(int $id)
    {
        $cliente = (new Clientes)->newQuery()->find($id);
        if (empty($cliente)) return '-';
        if ($cliente->nome && !$cliente->razao_social) return $cliente->nome;
        if ($cliente->nome && $cliente->razao_social) return $cliente->nome . ' - ' . $cliente->razao_social;
        if ($cliente->razao_social) return $cliente->razao_social;
        return '-';
    }
}

if (!function_exists('public_html_path')) {
    function public_html_path()
    {
        return __DIR__;
    }
}

if (!function_exists('modalSucesso')) {
    function modalSucesso($mensagem)
    {
        session()->flash('sucesso', $mensagem);
    }
}

if (!function_exists('modalErro')) {
    function modalErro($mensagem)
    {
        session()->flash('erro', $mensagem);
    }
}

if (!function_exists('getTaxaComissao')) {
    function getTaxaComissao($id): ?float
    {
        $comissao = new \App\Models\TaxaComissoes();
        return $comissao->getTaxas($id);
    }
}

if (!function_exists('deleteFileStorage')) {
    function deleteFileStorage($name)
    {
        $pathLogoAtual = public_path('storage') . '/' . $name;
        if (is_file($pathLogoAtual)) unlink($pathLogoAtual);
    }
}

if (!function_exists('getLogoPrincipal')) {
    function getLogoPrincipal($query = false)
    {
        $chave = (new \App\Services\Sistema\LogoService())->getChave();
        $logo = (new \App\Models\Configs())->newQuery()
            ->where('meta_key', $chave)->first();

        if (empty($logo->value)) return '';
        return $query ? $logo->value : asset('storage/' . $logo->value);
    }
}


