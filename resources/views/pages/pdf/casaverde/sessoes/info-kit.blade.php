<div class="body" style="font-family:sans-serif; color:#1F2E23; margin-top:22px;">
    <span style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Gerador Fotovoltaico</span>
    <table style="width:100%; margin-top:6px;">
        <tr style="border-bottom:1px solid #D9D3C3;">
            <td style="padding:8px 0; font-size:12px; color:#5B6F60; width:55%;">Modelo do Kit</td>
            <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $orcamentoKit->qtd_kits }}x {{ $kit->modelo }}</b></td>
        </tr>
        <tr style="border-bottom:1px solid #D9D3C3;">
            <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Potência total do Kit</td>
            <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }} kWp</b></td>
        </tr>
        <tr style="border-bottom:1px solid #D9D3C3;">
            <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Geração Estimada</td>
            <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $orcamento->geracao }} kWh/mês*</b></td>
        </tr>
        @if (!empty($trafo ?? null))
            <tr style="border-bottom:1px solid #D9D3C3;">
                <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Transformador</td>
                <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $trafo->modelo }}</b></td>
            </tr>
        @endif
    </table>
</div>
