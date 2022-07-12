<div>
    <div>
        <img src="storage/proposta-comercial/padrao/images/capa.png"/>
    </div>
    <div style="margin-top:-270px; padding-left:80px;color:rgb(68,90,99)">
        <span style="font-size:28px;">
            {{ get_nome_cliente($orcamento->clientes_id) }}<br>
        </span>
        <span style="font-size:22px;">
            Sistema fotovoltaico de {{ $kit->potencia_kit }} kWp<br>
        </span>
        ID do Orçamento: #{{ $orcamento->id }}
    </div>
</div>
