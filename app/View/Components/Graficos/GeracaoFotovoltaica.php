<?php

namespace App\View\Components\Graficos;

use App\Models\IrradiacaoSolar;
use Illuminate\View\Component;

class GeracaoFotovoltaica extends Component
{
    private float $geracao;
    private int $cidade;
    private float $media;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(float $geracao, int $cidade)
    {
        $this->geracao = $geracao;
        $this->cidade = $cidade;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $irradiacoes = $this->irradiacoes();
        $geracaoMensal = $this->geracaoMensal($irradiacoes);

        return view('components.graficos.geracao-fotovoltaica', compact('geracaoMensal'));
    }

    private function geracaoMensal($irradiacoes): array
    {
        $geracoes = [];

        $this->media = $irradiacoes->media;
        $geracoes['jan'] = $this->calc($irradiacoes->jan);
        $geracoes['fev'] = $this->calc($irradiacoes->fev);
        $geracoes['mar'] = $this->calc($irradiacoes->mar);
        $geracoes['abr'] = $this->calc($irradiacoes->abr);
        $geracoes['mai'] = $this->calc($irradiacoes->mai);
        $geracoes['jun'] = $this->calc($irradiacoes->jun);
        $geracoes['jul'] = $this->calc($irradiacoes->jul);
        $geracoes['ago'] = $this->calc($irradiacoes->ago);
        $geracoes['set'] = $this->calc($irradiacoes->set);
        $geracoes['out'] = $this->calc($irradiacoes->out);
        $geracoes['nov'] = $this->calc($irradiacoes->nov);
        $geracoes['dez'] = $this->calc($irradiacoes->dez);

        return $geracoes;
    }

    private function calc($irradiacao)
    {
        return round($irradiacao / $this->media * $this->geracao);
    }

    private function irradiacoes()
    {
        $irradiacoes = new IrradiacaoSolar();
        return $irradiacoes->todasIrradiacoes($this->cidade);
    }
}
