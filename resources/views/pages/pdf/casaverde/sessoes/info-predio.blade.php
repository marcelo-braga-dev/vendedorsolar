<div class="body" style="font-family:sans-serif; color:#1F2E23;">
    <span style="font-family:serif; font-size:20px; color:#1B4332;">Ficha técnica</span>
    <div style="width:30px; border-top:2px solid #C1622D; margin-top:6px; margin-bottom:14px;"></div>

    <span style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Unidade Consumidora</span>
    <table style="width:100%; margin-top:6px;">
        <tr style="border-bottom:1px solid #D9D3C3;">
            <td style="padding:8px 0; font-size:12px; color:#5B6F60; width:55%;">Cidade / Estado</td>
            <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ getCidadeEstado($orcamento->cidade) }}</b></td>
        </tr>
        @if ($metas)
            @if (!is_null($metas['consumo'] ?? null))
                <tr style="border-bottom:1px solid #D9D3C3;">
                    <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Média Consumo</td>
                    <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $metas['consumo'] }} kWh/mês</b></td>
                </tr>
            @endif
            @if (!is_null($metas['consumo_fora_ponta'] ?? null))
                <tr style="border-bottom:1px solid #D9D3C3;">
                    <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Consumo Fora da Ponta</td>
                    <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $metas['consumo_fora_ponta'] }} kWh/mês</b></td>
                </tr>
                <tr style="border-bottom:1px solid #D9D3C3;">
                    <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Consumo na Ponta</td>
                    <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $metas['consumo_ponta'] }} kWh/mês</b></td>
                </tr>
                <tr style="border-bottom:1px solid #D9D3C3;">
                    <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Demanda Contratada</td>
                    <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $metas['demanda'] }} kWh/mês</b></td>
                </tr>
            @endif
            <tr style="border-bottom:1px solid #D9D3C3;">
                <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Tipo de Estrutura</td>
                <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ getEstrutura($metas['estrutura'] ?? null) }}</b></td>
            </tr>
        @endif
        <tr style="border-bottom:1px solid #D9D3C3;">
            <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Irradiação Solar (Média Anual)</td>
            <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ str_replace('.', ',', getIrradiacao($orcamento->cidade)) }} kWh/m²</b></td>
        </tr>
        @if ($metas)
            <tr style="border-bottom:1px solid #D9D3C3;">
                <td style="padding:8px 0; font-size:12px; color:#5B6F60;">Tensão da Rede</td>
                <td style="padding:8px 0; font-size:12px; color:#1B4332; text-align:right;"><b>{{ $metas['tensao'] ?? '-' }} V</b></td>
            </tr>
        @endif
    </table>
</div>
