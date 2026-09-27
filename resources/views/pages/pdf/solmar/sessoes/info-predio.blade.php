<style>
    #tabela-padrao {

    }
</style>
<div class="body">
    <x-tables.table-default>
        <x-slot name="head">
            <tr>
                <th colspan="2">
                    Informações da Unidade Consumidora
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            <tr>
                <td>Cidade / Estado</td>
                <td>{{ getCidadeEstado($orcamento->cidade) }}</td>
            </tr>
            @if ($metas)
                @if (!is_null($metas['consumo'] ?? null))
                    <tr>
                        <td>Média Consumo</td>
                        <td>{{ $metas['consumo'] }} kWh/mês</td>
                    </tr>
                @endif
                @if (!is_null($metas['consumo_fora_ponta'] ?? null))
                    <tr>
                        <td>Média Consumo Fora da Ponta</td>
                        <td>{{ $metas['consumo_fora_ponta'] }} kWh/mês</td>
                    </tr>
                    <tr>
                        <td>Média Consumo na Ponta</td>
                        <td>{{ $metas['consumo_ponta'] }} kWh/mês</td>
                    </tr>
                    <tr>
                        <td>Demanda Contratada</td>
                        <td>{{ $metas['demanda'] }} kWh/mês</td>
                    </tr>
                @endif
                <tr>
                    <td>Tipo de Estrutura</td>
                    <td>{{ getEstrutura($metas['estrutura'] ?? null) }}</td>
                </tr>
            @endif
            <tr>
                <td>Irradiação Solar (Média Anual)</td>
                <td>{{ str_replace('.', ',', getIrradiacao($orcamento->cidade)) }} kWh/m²</td>
            </tr>
            @if ($metas)
                <tr>
                    <td>Tensão da Rede</td>
                    <td>{{ $metas['tensao'] ?? '-' }} V</td>
                </tr>
            @endif
        </x-slot>
    </x-tables.table-default>
</div>








