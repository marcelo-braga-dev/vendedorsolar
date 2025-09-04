<div class="body">
    <style>
        th, td {
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        #assinatura {
            border-top: 1px solid black;
            border-right: 0px;
            border-left: 0px;
            border-bottom: 0px;
            vertical-align: top;
        }

        #sem_borda {
            border: 0px solid white;
        }
    </style>
    <div style="text-align: center;">
        <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
        ____/____/________ <br>
        <span style="font-size:13px">
        Data da Assinatura
    </span>
        <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
    </div>
    <div style="margin-left: 80px">
        <img src="/storage/proposta-comercial/ecovolt/assinatura_ecovolt.png" width="200" />
    </div>
    
    <table border="0px" width="100%">
        <tr>
            <td id="sem_borda" width="5%"></td>
            <td id="assinatura" width="40%">
                <b>Eco Volt Energia</b><br>
                Sol Solar Energia Solar Eireli<br>
                CNPJ: 21.447.234/0001-51<br>
                (44) 9 9962-5721<br>
                contato@ecovoltenergia.com.br
            </td>

            <td id="sem_borda" width="10%"></td>

            <td id="assinatura" width="40%">
                <b>{{ getNomeCliente($orcamento->clientes_id) }}</b><br>
                {{$clienteDados['cnpj'] ? 'CNPJ: ' . $clienteDados['cnpj'] : 'CPF: ' . $clienteDados['cpf']}}<br>
                *Autorização para vistoria técnica
            </td>
            <td id="sem_borda" width="5%"></td>
        </tr>
    </table>
</div>

