<div class="body">
    <table id="tabela" >
        <tr style="background-image: linear-gradient(to bottom left, #00B6FF, #1589C0)">
            <th align="center" colspan="{{ count($bancos) }}" style="background-image: linear-gradient(to bottom left, rgb(16, 11, 77), rgba(16, 11, 77, 1)); color: white; padding: 10px">
                <span style=""><b>Financiamentos</b></span>
            </th>
        </tr>
        <tr style=" border:1px solid white;">
            @foreach($bancos as $items)
                <?php
                $calcJurosSicoob = 1 + ($items->juros_mensal / 100);
                $valorCarenciaSicoob = $orcamento->preco_cliente * pow($calcJurosSicoob, $items->carencia);
                $valorParcela = $valorCarenciaSicoob / ((1 - pow(($calcJurosSicoob), - $items->qtd_parcelas)) / ($items->juros_mensal / 100));
                ?>
                <td style="background-color:white; padding: 10px; text-align: center">
                    <img src="storage/{{ $items->img_logo }}" width="100"><br>
                    <span style="font-size: 12px;"><br>
                        {{ $items->qtd_parcelas }} x R$ {{ convert_float_money($valorParcela) }}
                    </span><br>
                    <span style="font-size: 10px">Carência de <?= $items->carencia ?> meses</span><br>
                </td>
            @endforeach
        </tr>
    </table>
</div>
