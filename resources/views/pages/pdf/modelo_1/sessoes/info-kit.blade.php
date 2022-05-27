<div class="body">
    <x-tables.table-default>
        <x-slot name="head">
            <tr>
                <th colspan="4">
                    Modelo do Gerador Fotovoltaico
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            <tr>
                <td colspan="4">
                    <b>{{ $kit->modelo }}</b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Potência do Gerador: {{ $kit->potencia_kit }} kWp
                </td>

                <td colspan="2">
                    Geração Estimado: {{ $orcamento->geracao }} kWh/mês*
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Área da Estrutura: m²
                </td>
                <td colspan="2">
                    Peso da Estrutura: kg/m²
                </td>
            </tr>
        </x-slot>
    </x-tables.table-default>
</div>
