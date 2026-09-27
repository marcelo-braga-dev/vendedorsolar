<div class="body" style="font-family:sans-serif; color:#1F2E23; margin-top:26px;">
    <table style="width:100%;">
        <tr>
            <td style="text-align:center; width:33%;">
                <img src="storage/proposta-comercial/solmar/assinatura-1.jpeg" style="width:150px;">
            </td>
            <td style="width:4%;"></td>
            <td style="text-align:center; width:33%;">
                <img src="storage/proposta-comercial/solmar/assinatura-engenheiro.jpg" style="width:130px;">
            </td>
            <td style="width:4%;"></td>
            <td style="text-align:center; width:33%;"></td>
        </tr>
        <tr>
            <td style="text-align:center; border-top:1px solid #1B4332; padding-top:10px; width:33%;">
                <span style="font-size:12px; color:#1B4332;"><b>Casa Verde</b></span><br>
                <span style="font-size:9px; color:#5B6F60;">
                    marca de Solmar Energia Solar Ltda<br>
                    CNPJ: 27.908.036/0001-24<br>
                    (44) 3029-1225
                </span>
            </td>
            <td style="width:4%;"></td>
            <td style="text-align:center; border-top:1px solid #1B4332; padding-top:10px; width:33%;">
                <span style="font-size:12px; color:#1B4332;"><b>MATHEUS ANDRE SILVA BRITO</b></span><br>
                <span style="font-size:9px; color:#5B6F60;">
                    Engenheiro Responsável<br>
                    CREA-PR 217975/D
                </span>
            </td>
            <td style="width:4%;"></td>
            <td style="text-align:center; border-top:1px solid #1B4332; padding-top:10px; width:33%;">
                <span style="font-size:12px; color:#1B4332;"><b>{{ getNomeCliente($cliente->id) }}</b></span><br>
                <span style="font-size:9px; color:#5B6F60;">
                    @if (!empty($dadosCliente['rg']))
                        RG: {{ $dadosCliente['rg'] }}<br>
                    @endif
                    @if (!empty($dadosCliente['cpf']))
                        CPF: {{ $dadosCliente['cpf'] }}<br>
                    @endif
                    @if (!empty($dadosCliente['cnpj']))
                        CNPJ: {{ $dadosCliente['cnpj'] }}<br>
                    @endif
                    *Aceite da Proposta Comercial
                </span>
            </td>
        </tr>
    </table>

    <div style="text-align:center; margin-top:40px;">
        <span style="font-size:11px; color:#8FA98C;">_____/_____/_________ &nbsp;&nbsp; Data da Assinatura</span>
    </div>
</div>
