<div class="body">
    <x-tables.table-default>
        <x-slot name="head">
            <tr>
                <th colspan="2" class="text-center">
                    Produtos do Kit
                </th>
            </tr>
            <tr>
                <th>Qtd. Kits</th>
                <th>Produtos por Kit</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            <tr>
                <td>{{ $orcamentoKit->qtd_kits }}x</td>
                <td>
                    @foreach(explode('<br />', nl2br($kit->produtos)) as $item)
                        - {{ $item  }}<br>
                    @endforeach
                    <small class="d-block">ID do Kit: #{{ $kit->id }}</small>
                </td>
            </tr>
        </x-slot>
    </x-tables.table-default>
    <span>
    Nesse orçamento está incluso a instalação, homologação, cabos CA até 10m do inversor.
    Não está incluso adequação de padrão de energia, estrutura e serviços de alvenaria, se houver.
</span>
    <br><br>
    <span style="text-align: left;">
    <strong>Garantias:</strong>
</span>
    <ul>
        @if($imagens[$kit->marca_inversor]['garantia'])
            <li style="text-align: left;">{{ $imagens[$kit->marca_inversor]['garantia'] }}</li>
        @endif
        @if($imagens[$kit->marca_painel]['garantia'])
            <li style="text-align: left;">{{ $imagens[$kit->marca_painel]['garantia'] }}</li>
        @endif
    </ul>
    <p style="text-align: left;">
        <strong>INVESTIMENTO SEGURO E RETORNO GARANTIDO</strong>
    </p>
    <ul style="text-align: left;">
        <li>Reduza até 95% de seu consumo na conta de luz;</li>
        <li>Valorização do imóvel e/ou da sua empresa;</li>
        <li>Pelo menos 20 anos de energia grátis após o retorno do investimento.</li>
    </ul>
    <p style="text-align: left;">
        <strong>SIMPLES E FÁCIL</strong>
    </p>
    <ul style="text-align: left;">
        <li>Instalação rápida e sem necessidade de obras - em média a instalação dura 3 dias;</li>
        <li>Baixíssima manutenção - basicamente limpeza e verificações.</li>
    </ul>
    <p style="text-align: left;"><strong>ENERGIA LIMPA E INFINITA</strong></p>
    <ul>
        <li style="text-align: left;">Energia 100% renovável;</li>
        <li style="text-align: left;">Sem ruídos e sem emissão de gases poluentes;</li>
        <li style="text-align: left;">Redução de impacto ambiental.</li>
    </ul>
</div>
