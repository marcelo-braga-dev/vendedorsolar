<div>
    <div>
        <img src="storage/orcamentos/bahia-solar/capa.jpg"/>
    </div>
    <div style="margin-top:-500px; text-align:center; padding-right:50px;color:rgb(68,90,99)">
        <span style="font-size:28px;">
            {{ get_nome_cliente($orcamento->clientes_id) }}<br><br>
        </span>
        <span style="font-size:22px;">
            Sistema fotovoltaico de {{ $kit->potencia_kit }} kWp<br>
        </span>
        ID do Orçamento: #{{ $orcamento->id }}
    </div>
</div>
