<?php

use App\Models\Clientes;
use App\Services\CidadesEstadosService;
use App\Services\EstruturasService;

require_once 'Helpers/dimensionamento.php';

if (!function_exists('get_status')) {
    function get_status($id = '')
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

if (!function_exists('get_estrutura')) {
    function get_estrutura($id = '')
    {
        $clsEstruturasService = new EstruturasService();

        $estrutura = $clsEstruturasService->get_estrutura($id);

        if (!empty($estrutura->nome)) return $estrutura->nome;

        return 'Inválido';
    }
}

if (!function_exists('get_estruturas')) {
    function get_estruturas()
    {
        $clsEstruturasService = new EstruturasService();

        return $clsEstruturasService->get_estruturas();
    }
}

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
        if (is_string($arg) && !is_float($arg)) {
            $arg = str_replace('.', '', $arg);
            $arg = str_replace(',', '.', $arg);
            $arg = number_format($arg, $decimais, '.', '');
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
    function nomeUsuario(int $id)
    {
        return (new \App\Models\User())->newQuery()->find($id)->name ?? '';
    }
}

if (!function_exists('get_cidades')) {
    function get_cidades()
    {
        return CidadesEstadosService::getCidades();
    }
}

if (!function_exists('get_estados')) {
    function get_estados()
    {
        return CidadesEstadosService::getEstados();
    }
}

if (!function_exists('getCidadeEstado')) {
    function getCidadeEstado(int $id)
    {
        $service = new CidadesEstadosService();
        return $service->getCidadeEstado($id);
    }
}

if (!function_exists('get_nome_cliente')) {
    function get_nome_cliente(int $id)
    {
        return Clientes::find($id)->nome;
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

if (!function_exists('converterStatusPadrao')) {
    function converterStatusPadrao($status): string
    {
        switch ($status) {
            case 0:
                return 'Desativado';
            case 1:
                return 'Ativo';
        }
        return 'Desconhecido';
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

if (!function_exists('getIrradiacao')) {
    function getIrradiacao($id)
    {
        $irradiacao = new \App\Models\IrradiacaoSolar();
        $valor = $irradiacao->newQuery()
            ->where('cidades_estados_id', '=', $id)
            ->first();

        return $valor->media ?? 0;
    }
}

if (!function_exists('getLogoPrincipal')) {
    function getLogoPrincipal()
    {
        $configs = new \App\Models\Configs();
        $logo = $configs->newQuery()
            ->where('meta', '=', 'logo_principal')
            ->first();

        if (empty($logo->value)) return '';
        return asset($logo->value);
    }
}

if (!function_exists('getNomeStatus')) {
    function getNomeStatus($status)
    {
        $todosStatus = (new \App\src\Orcamentos\Status\StatusOrcamentos())->todosStatus();
        return $todosStatus[$status];
    }
}
