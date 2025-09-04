<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Admin\Integracoes\Edeltec\EdeltecIntegracao;
use App\Http\Controllers\Controller;
use App\Models\Integracao\Edeltec\IntegracaoEdeltecHistorico;
use Illuminate\Http\Request;

class EldeltecController extends Controller
{
    public function index(Request $request)
    {
        // você pode trocar 15 por outro "por página"
        $historicos = IntegracaoEdeltecHistorico::query()
            ->orderByDesc('id')
            ->paginate(15);

        // Normaliza campos (arrays) e calcula contagens
        $historicos->getCollection()->transform(function ($h) {
            $importados  = is_array($h->produtos_importados)
                ? $h->produtos_importados
                : (array) json_decode($h->produtos_importados ?? '[]', true);

            $desativados = is_array($h->produtos_desativados)
                ? $h->produtos_desativados
                : (array) json_decode($h->produtos_desativados ?? '[]', true);

            $h->importados       = $importados;
            $h->desativados      = $desativados;
            $h->qtd_importados   = count($importados);
            $h->data_inicio_fmt  = optional($h->data_inicio)->format('d/m/Y H:i');
            $h->data_fim_fmt     = optional($h->data_fim ?? $h->updated_at)->format('d/m/Y H:i');

            // duração simples (em minutos e segundos)
            if ($h->data_inicio && ($h->data_fim ?? $h->updated_at)) {
                $inicio   = \Carbon\Carbon::parse($h->data_inicio);
                $fim      = \Carbon\Carbon::parse($h->data_fim ?? $h->updated_at);
                $segundos = $inicio->diffInSeconds($fim);

                $min = floor($segundos / 60);
                $sec = $segundos % 60;

                if ($segundos < 60) {
                    $h->duracao_fmt = "{$sec}s";
                } elseif ($segundos < 3600) {
                    $h->duracao_fmt = "{$min}min " . ($sec > 0 ? "{$sec}s" : '');
                } else {
                    $h->duracao_fmt = floor($min / 60) . "h " . ($min % 60) . "min " . ($sec > 0 ? "{$sec}s" : '');
                }
            } else {
                $h->duracao_fmt = '—';
            }


            return $h;
        });

        return view('pages.admin.integracoes.eldeltec.index', compact('historicos'));
    }

    public function integrar()
    {
        (new EdeltecIntegracao())->init();

        modalSucesso('Integração realizada com sucesso!');
        return redirect()->route('admin.integracoes.eldeltec.index');
    }
}
