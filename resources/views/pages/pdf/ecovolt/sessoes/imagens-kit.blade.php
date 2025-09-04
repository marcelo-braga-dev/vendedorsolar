<div class="body">
    <table style="text-align: center">
        <tr>
            <td>
                <div>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['produto'] }}" width="150"/><br>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['logo'] }}" width="150"/>
                    <br><br><span style="font-size:12px">Inversor</span>
                </div>
            </td>
            <td>
                <div>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['produto'] }}" width="150"/><br>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['logo'] }}" width="150"/>
                    <br><br><span style="font-size:12px">Painéis</span>
                </div>
            </td>
            @if (!empty($orcamento->trafo))
                <td>
                    <div>
                        <img src="{{ 'storage/'. $imagens[$idProdutoTrafo->id]['produto'] }}" width="150" alt="logo"/><br>
                        <img src="{{ 'storage/'. $imagens[$idProdutoTrafo->id]['logo'] }}" width="150" alt="logo"/>
                        <br><br><span style="font-size:12px">Transformador</span>
                    </div>
                </td>
            @endif
        </tr>
    </table>
    <br><br>
</div>
