<div class="body">
    <x-tables.table-default>
        <x-slot name="head">
            <tr>
                <th colspan="4">
                    Gerador Fotovoltaico
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            <tr>
                <td colspan="4">
                    <b>{{ $orcamento->qtd_kits }}x {{ $kit->modelo }}</b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Potência total dos Kit: {{ convert_float_money($kit->potencia_kit * $orcamento->qtd_kits, 3)  }} kWp
                </td>

                <td colspan="2">
                    Geração Estimado: {{ $orcamento->geracao }} kWh/mês*
                </td>
            </tr>
            {{--            <tr>--}}
            {{--                <td colspan="2">--}}
            {{--                    Área da Estrutura: m²--}}
            {{--                </td>--}}
            {{--                <td colspan="2">--}}
            {{--                    Peso da Estrutura: kg/m²--}}
            {{--                </td>--}}
            {{--            </tr>--}}
        </x-slot>
    </x-tables.table-default>

    @if (!empty($trafo))
        <br><br>
        <x-tables.table-default>
            <x-slot name="head">
                <tr>
                    <th colspan="4">
                        Modelo do Transformador
                    </th>
                </tr>
            </x-slot>
            <x-slot name="body">
                <tr>
                    <td colspan="4">
                        {{ $trafo->modelo }}
                    </td>
                </tr>
            </x-slot>
        </x-tables.table-default>
    @endif
</div>
