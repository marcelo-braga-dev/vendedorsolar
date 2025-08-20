<div class="body">
    <p>
        <b>Cliente:</b> {{ $proposta->cliente->nome ?? $proposta->cliente->razao_social }}
    </p>
    @if ($proposta->cliente->cpf ?? $proposta->cliente->cnpj)
        <p>
            <b>Documento:</b> {{ $proposta->cliente->cpf ?? $proposta->cliente->cnpj }}
        </p>
    @endif

    <p>
        <b>Valor da Proposta:</b> R$ {{ convert_float_money($proposta->valor) }}
    </p>
    @if ($proposta->prazo_final)
    <p>
        <b>Prazo:</b> {{ $proposta->prazo_final }}
    </p>
    @endif

    <small>
        <b>ID Proposta:</b> #{{ $proposta->id}}
    </small>

    <div style="border-top:  1px solid #ddd; margin-top: 15px; padding-top: 15px">
        <p>
            <b>{{ $proposta->titulo }}</b>
        </p>
        <p>
            {{ $proposta->descricao}}
        </p>
    </div>

</div>
