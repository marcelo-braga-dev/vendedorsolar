<div class="body">
    <p>
        <b>Cliente:</b> {{ $proposta->cliente->nome ?? $proposta->cliente->razao_social }}
    </p>
    @if($proposta->cliente->dados->cpf)
        <div class="col-12">
            <p>
                <b>CPF:</b> {{ $proposta->cliente->dados->cpf }}
            </p>
        </div>
    @endif
    @if($proposta->cliente->dados->cnpj)
        <div class="col-12">
            <p>
                <b>CNPJ:</b> {{ $proposta->cliente->dados->cnpj }}
            </p>
        </div>
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
            {!!  nl2br($proposta->descricao) !!}
        </p>
    </div>

    <div style="border-top:  1px solid #ddd; margin-top: 15px; padding-top: 15px">
        <div style="text-align: center;margin-bottom:60px">
            <br>
            _____/_____/_________ <br>
            <small>
                Data da Assinatura
            </small>
        </div>

        <table>
            <tr>
                <td style="width:2%"></td>
                <td id="assinatura" style="width:46%">
                    <b>Solmar Energia</b><br>
                    CNPJ: 27.908.036/0001-24
                </td>
                <td style="width:4%"></td>

                <td id="assinatura" style="width:46%">
                    <p>
                        <b>{{ $proposta->cliente->nome ?? $proposta->cliente->razao_social }}</b>
                    </p>
                    @if($proposta->cliente->dados->cpf)
                        <div class="col-12">
                            <p>
                                CPF: {{ $proposta->cliente->dados->cpf }}
                            </p>
                        </div>
                    @endif
                    @if($proposta->cliente->dados->cnpj)
                        <div class="col-12">
                            <p>
                                CNPJ: {{ $proposta->cliente->dados->cnpj }}
                            </p>
                        </div>
                    @endif
                    *Aceite da Proposta Comercial
                </td>
                <td style="width:2%"></td>
            </tr>
        </table>
    </div>

    <div style="border-top:  1px solid #ddd; margin-top: 15px; padding-top: 15px">
        <b>SOLMAR ENERGIA SOLAR LTDA</b><br/>
        CNPJ: 27.908.036/0001-24<br/>
        Tel: (44) 99990-3092 | Email: contato@solmarenergia.com.br<br/>

        Av. Mandacaru, 4943 - Jardim Munique, Maringá - PR, 87084-002.
    </div>
</div>

<style>
    th, td {
        padding: 8px;
        text-align: center;
        vertical-align: middle;
    }

    #assinatura {
        border-top: 1px solid black;
        border-right: 0;
        border-left: 0;
        border-bottom: 0;
        vertical-align: top;
    }

    #sem_borda {
        border: 0 solid white;
    }
</style>
