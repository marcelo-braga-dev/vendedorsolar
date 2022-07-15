<?php

namespace App\src\Integracoes\Aldo\AcoesAoLerArquivo;

class PesquisaTags implements Acoes
{
    private $indices;
    private $infos;

    public function __construct()
    {
        $this->infos = [];
    }

    public function executar($dados, $tags)
    {
        if (
            $dados->marca_site == 'ALDO SOLAR ON GRID' &&
            $dados->atributos->TIPO_PRODUTO == 'GERADOR' &&
            $dados->segmento_site == 'ENERGIA SOLAR'
        ) {
            $this->indices = $tags;
            $this->getIndices($dados);
        }
        if (
            $dados->atributos->TIPO_PRODUTO == 'TRANSFORMADOR' &&
            $dados->segmento_site == 'ENERGIA SOLAR'
        ) {
            $this->getIndicesTrafos($dados, $tags);
        }
    }

    private function getIndices($dados)
    {
        $this->TIPO_ESTRUTURA($dados);
        $this->MARCA_INVERSOR($dados);
        $this->MARCA_PAINEL($dados);
    }

    private function TIPO_ESTRUTURA($dados)
    {
        if (strip_tags($dados->atributos->TIPO_ESTRUTURA)) {
            $dado = strip_tags($dados->atributos->TIPO_ESTRUTURA);

            $this->infos['estruturas'][$dado] = $this->indices['estrutura'][$dado]['id_referencia'];
        }
    }

    private function MARCA_INVERSOR($dados)
    {
        if (strip_tags($dados->atributos->MARCA_INVERSOR)) {
            $dado = strip_tags($dados->atributos->MARCA_INVERSOR);

            if (empty($this->indices['inversor'][$dado]['id_referencia'])) {
                $this->infos['inversores'][$dado] = [];
                return;
            }

            $this->infos['inversores'][$dado] = $this->indices['inversor'][$dado]['id_referencia'];
        }
    }

    private function MARCA_PAINEL($dados)
    {
        if (strip_tags($dados->atributos->MARCA_PAINEL)) {
            $dado = strip_tags($dados->atributos->MARCA_PAINEL);

            if (empty($this->indices['painel'][$dado]['id_referencia'])) {
                $this->infos['painel'][$dado] = [
                    'id_referencia' => '',
                    'potencia' => ''
                ];

                return;
            }

            $this->infos['painel'][$dado] = [
                'id_referencia' => $this->indices['painel'][$dado]['id_referencia'],
                'potencia' => $this->indices['painel'][$dado]['potencia']
            ];
        }
    }

    public function getInfos()
    {
        return $this->infos;
    }

    private function getIndicesTrafos($dados, $tags): void
    {
        $marca = strip_tags($dados->marca);
        if (!empty($tags['trafo'][$marca])) {
            $this->infos['trafos'][$marca] =
                $tags['trafo'][$marca]['id_referencia'];
        }
    }
}
