<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Admin\Integracoes\Edeltec\EdeltecIntegracao;
use App\Http\Controllers\Controller;
use App\Models\Integracao\Edeltec\IntegracaoEdeltecHistorico;

class EldeltecController extends Controller
{
    public function index()
    {
        $historicos = IntegracaoEdeltecHistorico::query()
            ->orderByDesc('id')
            ->paginate(15);

        $historicos->getCollection()->transform(function ($h) {
            $h->data_inicio_fmt = optional($h->data_inicio)->format('d/m/Y H:i');
            $h->data_fim_fmt    = optional($h->data_fim ?? $h->updated_at)->format('d/m/Y H:i');
            $h->duracao_fmt     = $this->formatarDuracao($h->data_inicio, $h->data_fim ?? $h->updated_at);
            return $h;
        });

        return view('pages.admin.integracoes.eldeltec.index', compact('historicos'));
    }

    public function integrar()
    {
        // Permite execução longa sem ser interrompido pelo timeout do PHP
        set_time_limit(0);

        (new EdeltecIntegracao())->init();

        modalSucesso('Integração realizada com sucesso!');
        return redirect()->route('admin.integracoes.eldeltec.index');
    }

    private function formatarDuracao($inicio, $fim): string
    {
        if (!$inicio || !$fim) {
            return '—';
        }

        $segundos = \Carbon\Carbon::parse($inicio)->diffInSeconds(\Carbon\Carbon::parse($fim));

        if ($segundos < 60) {
            return "{$segundos}s";
        }

        $min = floor($segundos / 60);
        $sec = $segundos % 60;

        if ($segundos < 3600) {
            return "{$min}min" . ($sec > 0 ? " {$sec}s" : '');
        }

        $h   = floor($min / 60);
        $min = $min % 60;

        return "{$h}h" . ($min > 0 ? " {$min}min" : '') . ($sec > 0 ? " {$sec}s" : '');
    }
}
