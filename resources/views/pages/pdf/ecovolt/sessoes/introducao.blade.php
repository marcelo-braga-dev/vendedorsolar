<style>
    #tabela-introducao {
        text-align: center;
    }
    #tabela-introducao tr th {
        text-align: center;
        background-color: transparent;
        color: white;
        padding: 8px;
    }
    #tabela-introducao tr td {
        padding: 8px;
    }
</style>

<div class="body">
    <table id="tabela" style="background-image: linear-gradient(to bottom left, rgb(16, 11, 77), rgba(16, 11, 77, 1));">
        <tr>
            <th align="center" style="background-color:rgba(0,0,0,0); color: white; padding: 10px">
                <span style=""><b>Cliente</b></span>
            </th>
            <th align="center" style="background-color:rgba(0,0,0,0); color: white">
                <span><b>Representante</b></span>
            </th>
        </tr>
        <tr style=" border:1px solid white;">
            <td align="center" style="background-color:white; padding: 10px">
                <font color="black" size="5">
                    {{ getNomeCliente($orcamento->clientes_id) }}
                </font>
            </td>
            <td align="center" style="background-color:white;  padding: 10px">
                <font color="black" size="5">
                    {{ $vendedor->name }}
                </font>
            </td>
        </tr>
    </table>
    <br><br>

    <table>
        <tr>
            <td style="text-align:center; font-size:22px; background-color: rgb(16, 11, 77); color:white; padding:20px">
                Valor Total do Projeto
            </td>
            <td style="text-align:center; font-size:22px;background-color: rgba(16, 11, 77, 0.05)">
                <b>R$ {{ convert_float_money($orcamento->preco_cliente) }}</b>
            </td>
        </tr>
    </table>
    <div style="text-align:right">
        <small>
            Data da proposta: {{ date('d/m/y', strtotime($orcamento->created_at)) }} - Válido por 7 dias
        </small>
    </div>
    <br>
</div>
