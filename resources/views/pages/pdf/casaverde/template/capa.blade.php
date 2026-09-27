<div style="background-color:#F5F1E6; width:100%; height:297mm; padding:55px 50px; box-sizing:border-box; color:#1F2E23; font-family:sans-serif;">
    <table style="width:100%;">
        <tr>
            <td style="text-align:left; vertical-align:top; width:70%;">
                <span style="font-size:12px; letter-spacing:4px; text-transform:uppercase; color:#1B4332;"><b>Casa Verde</b></span>
                <div style="width:36px; border-top:2px solid #C1622D; margin-top:8px;"></div>
            </td>
            <td style="text-align:right; vertical-align:top; width:30%;">
                <table style="width:80px; margin-left:auto;">
                    <tr>
                        <td style="width:80px; height:80px; border-radius:50%; background-color:#1B4332;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="margin-top:245px;">
        <span style="font-family:serif; font-size:40px; line-height:1.25; color:#1B4332;">
            <b>Energia solar,<br>do jeito Casa Verde.</b>
        </span>
        <div style="margin-top:16px; font-size:13px; color:#5B6F60; width:380px;">
            Um projeto pensado para reduzir sua conta de luz, com equipamentos
            confiáveis e acompanhamento próximo do início ao fim da instalação.
        </div>
    </div>

    <table style="width:100%; margin-top:175px; border-top:1px solid #D9D3C3;">
        <tr>
            <td style="padding-top:16px; text-align:left; width:50%;">
                <span style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Preparado para</span><br>
                <span style="font-size:18px; color:#1B4332;">{{ getNomeCliente($orcamento->clientes_id) }}</span>
            </td>
            <td style="padding-top:16px; text-align:right; width:50%;">
                <span style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Proposta</span><br>
                <span style="font-size:18px; color:#1B4332;">#{{ $orcamento->id }}</span>
            </td>
        </tr>
    </table>
</div>
