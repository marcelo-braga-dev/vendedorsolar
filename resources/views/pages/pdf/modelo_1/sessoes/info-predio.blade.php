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
                <td>cidade / estado</td>
            </tr>
            <tr>
                <td>Consumo Médio Anual</td>
                <td>{{ $orcamento->consumo }} kWh/mês</td>
            </tr>
            <tr>
                <td>Tipo de Estrutura</td>
                <td>{{ get_estrutura($orcamento->estrutura) }}</td>
            </tr>
            <tr>
                <td>Irradiação Solar (Média Anual)</td>
                <td> kWh/m²</td>
            </tr>
            <tr>
                <td>Tensão da Rede</td>
                <td>{{ $orcamento->tensao }} V</td>
            </tr>
        </x-slot>
    </x-tables.table-default>
</div>








