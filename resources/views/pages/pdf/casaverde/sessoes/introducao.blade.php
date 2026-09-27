<div class="body" style="font-family:sans-serif; color:#1F2E23;">
    <span style="font-family:serif; font-size:26px; color:#1B4332;">
        Olá, {{ getNomeCliente($cliente->id) }}.
    </span>
    <div style="margin-top:10px; font-size:13px; color:#5B6F60; width:420px;">
        Preparamos esta proposta com base no seu perfil de consumo. Abaixo, o resumo do
        investimento e, nas próximas páginas, todos os detalhes técnicos do projeto.
    </div>
    <div style="margin-top:8px; font-size:11px; color:#8FA98C;">
        Consultor responsável: <b style="color:#1B4332;">{{ $vendedor->name }}</b>
        &nbsp;·&nbsp; Válida por 7 dias a partir de {{ date('d/m/Y', strtotime($orcamento->created_at)) }}
    </div>

    <table style="width:100%; margin-top:36px; border-top:1px solid #D9D3C3; border-bottom:1px solid #D9D3C3;">
        <tr>
            <td style="text-align:center; padding:18px 6px; width:34%; border-right:1px solid #D9D3C3;">
                <span style="font-family:serif; font-size:26px; color:#C1622D;"><b>R$ {{ convert_float_money($orcamento->preco_cliente) }}</b></span><br>
                <span style="font-size:9px; letter-spacing:1px; text-transform:uppercase; color:#8FA98C;">Investimento total</span>
            </td>
            <td style="text-align:center; padding:18px 6px; width:33%; border-right:1px solid #D9D3C3;">
                <span style="font-family:serif; font-size:26px; color:#C1622D;"><b>{{ $orcamento->geracao }}</b></span><br>
                <span style="font-size:9px; letter-spacing:1px; text-transform:uppercase; color:#8FA98C;">kWh gerados / mês*</span>
            </td>
            <td style="text-align:center; padding:18px 6px; width:33%;">
                <span style="font-family:serif; font-size:26px; color:#C1622D;"><b>{{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }}</b></span><br>
                <span style="font-size:9px; letter-spacing:1px; text-transform:uppercase; color:#8FA98C;">kWp instalados</span>
            </td>
        </tr>
    </table>
</div>
