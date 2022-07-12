<div class="body">
    <table>
        <tr>
            <th>
                <span><b>Cliente</b></span>
            </th>
            <th>
                <span><b>Vendedor</b></span>
            </th>
        </tr>
        <tr style="border:1px solid white;">
            <td style="font-size: 16px">
                @if (!empty($cliente->nome)) Nome: {{ $cliente->nome }}<br> @endif
                @if (!empty($dadosCliente['razao_social'])) Razao Social: {{ $dadosCliente['razao_social'] }}<br> @endif
                @if (!empty($dadosCliente['cpf'])) CPF: {{ $dadosCliente['cpf'] }}<br> @endif
                @if (!empty($dadosCliente['cnpj'])) CNPJ: {{ $dadosCliente['cnpj'] }}<br> @endif
                @if (!empty($dadosCliente['celular'])) Celular: {{ $dadosCliente['celular'] }}<br> @endif
                @if (!empty($dadosCliente['telefone'])) Telefone: {{ $dadosCliente['telefone'] }}<br> @endif
                @if (!empty($dadosCliente['email'])) Email: {{ $dadosCliente['email'] }}<br> @endif
            </td>
            <td style="font-size: 16px">
                @if (!empty($vendedor->name)) Nome: {{ $vendedor->name }}<br> @endif
{{--                Telefone: {{ $vendedor->telefone }}<br>--}}
                Email: {{ $vendedor->email }}<br>
            </td>
        </tr>
    </table>
    <br>
    <div class="bg-principal" style="text-align: center; padding: 15px">
        <span style="font-size:18px; color: white">
            Valor Total da Proposta: <b>R$ {{ $orcamento->preco_cliente }}</b>
        </span>
    </div>
</div>
