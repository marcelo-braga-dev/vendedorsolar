<div class="body">
    <table style="text-align: center">
        <tr>
            <td>
                <div>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['logo'] }}" width="150" alt="logo"/>
                    <br><br><span style="font-size:12px">Inversor</span>
                </div>
            </td>
            <td>
                <div>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['logo'] }}" width="150" alt="logo"/>
                    <br><br><span style="font-size:12px">Painéis</span>
                </div>
            </td>
            @if (!empty($orcamento->trafo))
                <td>
                    <div>
                        <img src="{{ 'storage/'. $imagens[$idProdutoTrafo->id]['logo'] }}" width="150" alt="logo"/>
                        <br><br><span style="font-size:12px">Transformador</span>
                    </div>
                </td>
            @endif
        </tr>
    </table>
    <br><br>
    <x-tables.table-default>
        <x-slot name="head">
            <tr>
                <th colspan="2" class="text-center">
                    Produtos do Kit
                </th>
            </tr>
            <tr>
                <th>
                    Qtd. Kits
                </th>
                <th>Produtos por Kit</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            <tr>
                <td>{{ $orcamento->qtd_kits }}x</td>
                <td>
                    @foreach(explode('<br />',nl2br($kit->produtos)) as $item)
                        {{ $item  }}<br>
                    @endforeach
                    <small>ID do Kit: #{{ $kit->id }}</small>
                </td>
            </tr>
        </x-slot>
    </x-tables.table-default>
    <h5><b>Garantias:</b></h5>
    <p>Painéis Fotovoltaicos: 10 a 12 anos pelo fabricante, 25 anos de vida útil</p>
    <p>Inversores: 07 a 10 anos pelo fabricante, 10 anos de vida útil</p>
    <p>Estruturas: 10 anos pelo fabricante - Materiais em Aço Galvanizado à Fogo / Aço Inox / Alumínio</p>
</div>
