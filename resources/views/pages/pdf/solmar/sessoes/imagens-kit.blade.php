<div class="body">
    <table style="text-align: center">
        <tr>
            <td>
                <div>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['produto'] }}" width="150"/><br>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['logo'] }}" width="150"/>
                    <br><br><span style="font-size:12px">Inversor</span>
                </div>
            </td>
            <td>
                <div>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['produto'] }}" width="150"/><br>
                    <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['logo'] }}" width="150"/>
                    <br><br><span style="font-size:12px">Painéis</span>
                </div>
            </td>
            @if (!empty($trafo->id))
                <td>
                    <div>
                        <img src="{{ 'storage/'. $imagens[$trafo->produtos_id]['produto'] }}" width="150"/><br>
                        <img src="{{ 'storage/'. $imagens[$trafo->produtos_id]['logo'] }}" width="150" alt="logo"/>
                        <br><br><span style="font-size:12px">Transformador</span>
                    </div>
                </td>
            @endif
        </tr>
    </table>
    <br><br>
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
                <td style="text-align: left">
                    @foreach(explode('</tr>', nl2br($orcamentoKit->produtos)) as $item)
                        {{str_replace('EDELTEC ', '', strip_tags($item))}}<br>
                    @endforeach
                    <small class="d-block">ID do Kit: #{{ $kit->id }}</small>
                    @php($precoTrafo = $trafo->preco_fornecedor ?? 0)
                    <small>RTD{{ round($kit->preco_fornecedor + $precoTrafo) }}HA</small>
                </td>
            </tr>
        </x-slot>
    </x-tables.table-default>
    
    <div style="text-align: center">
        <img src="/storage/proposta-comercial/solmar/conteudos/card-1.jpg" width="350"/><br><br>
    </div>
    

    <span>
        Nesse orçamento está incluso a instalação, homologação, cabos CA até 10m do inversor.
        Não está incluso adequação de padrão de energia, estrutura e serviços de alvenaria, se houver.
    </span>
    <br><br><br><br>
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

<div class="body">
    <b>SERVIÇOS INCLUSOS</b><br>
    1. Vistoria técnica e projeto elétrico do sistema.<br>
    2. Anotação da responsabilidade técnica (ART) do projeto e instalação.<br>
    3. Obtenção das licenças junto à concessionária de energia local.<br>
    4. Montagem dos módulos fotovoltaicos com estruturas apropriadas para o tipo de telhado/solo.<br>
    5. Instalação e montagem elétrica do sistema.<br>
    6. Gestão, supervisão e fiscalização da Obra de instalação.<br>
    7. Frete incluso de todos equipamentos referentes ao sistema.<br>
    8. Documentação personalizada do projeto fotovoltaico.<br>
    OBS: Não estão inclusos eventuais serviços de alvenaria, reforço estrutural, e/ou alterações na rede de distribuição as quais eventualmente podem ser solicitadas pela concessionária.

    <br><br><br>

    <b>CONSIDERAÇÕES FINAIS E VALIDADE</b><br>
    1. Os valores apresentados de geração de energia são estimativas baseadas em informações consultadas no banco de dados do CRESESB,
    e representam médias mensais e anuais, sendo que a geração varia de acordo com os meses do ano, assim como de acordo com fatores meteorológicos.<br>
    2. As estimativas de geração de energia, custos e economia foram baseadas e projetadas de acordo com as informações de consumo apresentadas pelo cliente,
    o estudo de irradiação solar local e a análise da inflação energética nos últimos anos. 3. O sistema proposto foi projetado considerando-se o atual perfil
    de consumo do cliente, tal como de acordo com os requisitos apresentados pelo cliente.<br>
    4. Por não possuir partes móveis, o sistema não exige manutenção preventiva. Periodicamente
    (6 meses a 1 ano), é recomendável a limpeza dos módulos fotovoltaicos para otimizar a geração de energia, especialmente em regiões/estações
    secas.<br>
{{--    Esta proposta é válida até 10/07/2024--}}
</div>


