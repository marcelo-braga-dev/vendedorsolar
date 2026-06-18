<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosDimensionamento extends Model
{
    use HasFactory;

    public string $margemPerda = 'margem_perda';
    public string $sobraPotencia = 'sobra_potencia';
    public string $perdaNordesteNoroeste = 'nordeste_noroeste';
    public string $perdaLesteOeste = 'leste_oeste';
    public string $perdaSudesteSudoeste = 'sudeste_sudoeste';
    public string $perdaSul = 'sul';
    public string $orientacaoInstalacao = 'orientacao_instalacao';
    public string $ajusteCalculo = 'ajuste_calculo';

    public string $performanceRatio = 'performance_ratio';
    public string $perdaTemperatura = 'temperatura';
    public string $perdaSujeira = 'sujeira';
    public string $perdaSombreamento = 'sombreamento';
    public string $perdaCabeamento = 'cabeamento';
    public string $perdaMismatch = 'mismatch';
    public string $perdaDegradacaoInicial = 'degradacao_inicial';

    public string $financeiro = 'financeiro';
    public string $degradacaoAno1 = 'degradacao_ano1';
    public string $degradacaoAnual = 'degradacao_anual';
    public string $inflacaoEnergetica = 'inflacao_energetica';
    public string $fioBPercentualTarifa = 'fio_b_percentual_tarifa';

    protected $fillable = [
        'meta_key',
        'meta',
        'name',
        'value'
    ];

    public function getMargemPerda()
    {
        return $this->newQuery()
                ->where('meta', '=', $this->ajusteCalculo)
                ->where('meta_key', '=', $this->margemPerda)
                ->first()
                ->value ?? '';
    }

    public function setMargemPerda($margemPerda): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->ajusteCalculo, 'meta_key' => $this->margemPerda],
                ['value' => $margemPerda]
            );
    }

    public function getSobraPotencia()
    {
        return $this->newQuery()
                ->where('meta', '=', $this->ajusteCalculo)
                ->where('meta_key', '=', $this->sobraPotencia)
                ->first()
                ->value ?? '';
    }

    public function setSobraPotencia($sobraPotencia): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->ajusteCalculo, 'meta_key' => $this->sobraPotencia],
                ['value' => $sobraPotencia]
            );
    }

    public function getPerdaNordesteNoroeste(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaNordesteNoroeste)
                ->first()
                ->value ?? '';
    }

    public function setPerdaNordesteNoroeste($perdaNordesteNoroeste): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaNordesteNoroeste],
                ['name' => 'Nordeste/Noroeste', 'value' => $perdaNordesteNoroeste]
            );
    }

    public function getPerdaLesteOeste(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaLesteOeste)
                ->first()
                ->value ?? '';
    }

    public function setPerdaLesteOeste($perdaLesteOeste): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaLesteOeste],
                ['name' => 'Leste/Oeste', 'value' => $perdaLesteOeste]
            );
    }

    public function getPerdaSudesteSudoeste(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaSudesteSudoeste)
                ->first()
                ->value ?? '';
    }

    public function setPerdaSudesteSudoeste($perdaSudesteSudoeste): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaSudesteSudoeste],
                ['name' => 'Sudeste/Sudoeste', 'value' => $perdaSudesteSudoeste]
            );
    }

    public function getPerdaSul(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->orientacaoInstalacao)
                ->where('meta_key', '=', $this->perdaSul)
                ->first()
                ->value ?? '';
    }

    public function setPerdaSul($perdaSul): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->orientacaoInstalacao, 'meta_key' => $this->perdaSul],
                ['name' => 'Sul', 'value' => $perdaSul]
            );
    }

    public function getOrientacoes()
    {
        return $this->newQuery()
            ->where('meta', '=', $this->orientacaoInstalacao)
            ->get(['meta_key', 'name']);
    }

    public function getPerdaTemperatura(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->performanceRatio)
                ->where('meta_key', '=', $this->perdaTemperatura)
                ->first()
                ->value ?? '';
    }

    public function setPerdaTemperatura($perdaTemperatura): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->performanceRatio, 'meta_key' => $this->perdaTemperatura],
                ['name' => 'Temperatura', 'value' => $perdaTemperatura]
            );
    }

    public function getPerdaSujeira(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->performanceRatio)
                ->where('meta_key', '=', $this->perdaSujeira)
                ->first()
                ->value ?? '';
    }

    public function setPerdaSujeira($perdaSujeira): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->performanceRatio, 'meta_key' => $this->perdaSujeira],
                ['name' => 'Sujeira', 'value' => $perdaSujeira]
            );
    }

    public function getPerdaSombreamento(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->performanceRatio)
                ->where('meta_key', '=', $this->perdaSombreamento)
                ->first()
                ->value ?? '';
    }

    public function setPerdaSombreamento($perdaSombreamento): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->performanceRatio, 'meta_key' => $this->perdaSombreamento],
                ['name' => 'Sombreamento', 'value' => $perdaSombreamento]
            );
    }

    public function getPerdaCabeamento(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->performanceRatio)
                ->where('meta_key', '=', $this->perdaCabeamento)
                ->first()
                ->value ?? '';
    }

    public function setPerdaCabeamento($perdaCabeamento): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->performanceRatio, 'meta_key' => $this->perdaCabeamento],
                ['name' => 'Cabeamento', 'value' => $perdaCabeamento]
            );
    }

    public function getPerdaMismatch(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->performanceRatio)
                ->where('meta_key', '=', $this->perdaMismatch)
                ->first()
                ->value ?? '';
    }

    public function setPerdaMismatch($perdaMismatch): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->performanceRatio, 'meta_key' => $this->perdaMismatch],
                ['name' => 'Mismatch', 'value' => $perdaMismatch]
            );
    }

    public function getPerdaDegradacaoInicial(): string
    {
        return $this->newQuery()
                ->where('meta', '=', $this->performanceRatio)
                ->where('meta_key', '=', $this->perdaDegradacaoInicial)
                ->first()
                ->value ?? '';
    }

    public function setPerdaDegradacaoInicial($perdaDegradacaoInicial): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->performanceRatio, 'meta_key' => $this->perdaDegradacaoInicial],
                ['name' => 'Degradação inicial (LID)', 'value' => $perdaDegradacaoInicial]
            );
    }

    /**
     * PR composto a partir dos 6 fatores configurados pelo admin. Os valores
     * padrão (seed) foram calibrados para reproduzir o antigo 15% fixo
     * (PR = 0.85) no primeiro deploy — ver migration de seed.
     */
    public function getPerformanceRatio(): float
    {
        return \App\src\Orcamentos\Dimensionamento\PerformanceRatio::compor([
            $this->getPerdaTemperatura(),
            $this->getPerdaSujeira(),
            $this->getPerdaSombreamento(),
            $this->getPerdaCabeamento(),
            $this->getPerdaMismatch(),
            $this->getPerdaDegradacaoInicial(),
        ]);
    }

    /**
     * Perda de geração (%) por direção de instalação do telhado.
     * 'norte' e 'desconsiderar' não têm perda configurável: norte é a orientação
     * ideal no hemisfério sul (perda 0) e 'desconsiderar' significa que o vendedor
     * optou por não informar/aplicar perda por orientação.
     */
    public function getPerdaPorOrientacao(string $orientacao): float
    {
        $metaKey = match ($orientacao) {
            'nordeste_noroeste' => $this->perdaNordesteNoroeste,
            'leste_oeste' => $this->perdaLesteOeste,
            'sudeste_sudoeste' => $this->perdaSudesteSudoeste,
            'sul' => $this->perdaSul,
            default => null,
        };

        if ($metaKey === null) {
            return 0.0;
        }

        return (float) ($this->newQuery()
            ->where('meta', '=', $this->orientacaoInstalacao)
            ->where('meta_key', '=', $metaKey)
            ->first()
            ->value ?? 0);
    }

    public function getDegradacaoAno1(): float
    {
        return (float) ($this->newQuery()
                ->where('meta', '=', $this->financeiro)
                ->where('meta_key', '=', $this->degradacaoAno1)
                ->first()
                ->value ?? 0);
    }

    public function setDegradacaoAno1($valor): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->financeiro, 'meta_key' => $this->degradacaoAno1],
                ['name' => 'Degradação no 1º ano (LID)', 'value' => $valor]
            );
    }

    public function getDegradacaoAnual(): float
    {
        return (float) ($this->newQuery()
                ->where('meta', '=', $this->financeiro)
                ->where('meta_key', '=', $this->degradacaoAnual)
                ->first()
                ->value ?? 0);
    }

    public function setDegradacaoAnual($valor): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->financeiro, 'meta_key' => $this->degradacaoAnual],
                ['name' => 'Degradação anual (a partir do 2º ano)', 'value' => $valor]
            );
    }

    public function getInflacaoEnergetica(): float
    {
        return (float) ($this->newQuery()
                ->where('meta', '=', $this->financeiro)
                ->where('meta_key', '=', $this->inflacaoEnergetica)
                ->first()
                ->value ?? 0);
    }

    public function setInflacaoEnergetica($valor): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->financeiro, 'meta_key' => $this->inflacaoEnergetica],
                ['name' => 'Inflação energética anual (estimativa)', 'value' => $valor]
            );
    }

    /**
     * Percentual estimado que a parcela TUSD-Fio B representa da tarifa
     * cheia — usado como aproximação nacional simplificada (sem decompor a
     * tarifa por concessionária) para calcular o custo do Fio B (Lei
     * 14.300/2022) sobre a energia injetada na rede.
     */
    public function getFioBPercentualTarifa(): float
    {
        return (float) ($this->newQuery()
                ->where('meta', '=', $this->financeiro)
                ->where('meta_key', '=', $this->fioBPercentualTarifa)
                ->first()
                ->value ?? 0);
    }

    public function setFioBPercentualTarifa($valor): void
    {
        $this->newQuery()
            ->updateOrInsert(
                ['meta' => $this->financeiro, 'meta_key' => $this->fioBPercentualTarifa],
                ['name' => 'Fio B (% estimado da tarifa cheia)', 'value' => $valor]
            );
    }

}
