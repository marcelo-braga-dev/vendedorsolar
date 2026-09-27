<div class="body" style="font-family:sans-serif; color:#1F2E23; margin-top:22px;">
    <table style="width:100%; text-align:center;">
        <tr>
            <td>
                <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['produto'] }}" width="130"/><br>
                <img src="{{ 'storage/'. $imagens[$kit->marca_inversor]['logo'] }}" width="130"/>
                <br><br><span style="font-size:10px; letter-spacing:1px; text-transform:uppercase; color:#8FA98C;">Inversor</span>
            </td>
            <td>
                <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['produto'] }}" width="130"/><br>
                <img src="{{ 'storage/'. $imagens[$kit->marca_painel]['logo'] }}" width="130"/>
                <br><br><span style="font-size:10px; letter-spacing:1px; text-transform:uppercase; color:#8FA98C;">Painéis</span>
            </td>
            @if (!empty($trafo->id ?? null))
                <td>
                    <img src="{{ 'storage/'. $imagens[$trafo->produtos_id]['produto'] }}" width="130"/><br>
                    <img src="{{ 'storage/'. $imagens[$trafo->produtos_id]['logo'] }}" width="130" alt="logo"/>
                    <br><br><span style="font-size:10px; letter-spacing:1px; text-transform:uppercase; color:#8FA98C;">Transformador</span>
                </td>
            @endif
        </tr>
    </table>

    <div style="margin-top:18px; font-size:11px; color:#5B6F60;">
        @foreach(explode('</tr>', nl2br($orcamentoKit->produtos)) as $item)
            {{ str_replace('EDELTEC ', '', strip_tags($item)) }}<br>
        @endforeach
        <span style="color:#8FA98C;">ID do Kit: #{{ $kit->id }}</span>
    </div>

    <div style="margin-top:10px; font-size:11px; color:#5B6F60;">
        Nesse orçamento está incluso a instalação, homologação, cabos CA até 10m do inversor.
        Não está incluso adequação de padrão de energia, estrutura e serviços de alvenaria, se houver.
    </div>

    <table style="width:100%; margin-top:26px;">
        <tr>
            <td style="width:50%; vertical-align:top; padding-right:18px;">
                <span style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Garantias</span>
                <div style="margin-top:8px; font-size:11px; color:#1F2E23;">
                    @if($imagens[$kit->marca_inversor]['garantia'])
                        <div style="margin-bottom:6px;">✓ {{ $imagens[$kit->marca_inversor]['garantia'] }}</div>
                    @endif
                    @if($imagens[$kit->marca_painel]['garantia'])
                        <div>✓ {{ $imagens[$kit->marca_painel]['garantia'] }}</div>
                    @endif
                </div>
                <br><br>
                <div style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Investimento seguro</div>
                <div style="margin-top:8px; font-size:11px; color:#1F2E23;">
                    <div style="margin-bottom:6px;">✓ Reduza até 95% de seu consumo na conta de luz</div>
                    <div style="margin-bottom:6px;">✓ Valorização do imóvel e/ou da sua empresa</div>
                    <div>✓ Pelo menos 20 anos de energia grátis após o retorno do investimento</div>
                </div>
            </td>
            <td style="width:50%; vertical-align:top; padding-left:18px; border-left:1px solid #D9D3C3;">
                <div style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Simples e fácil</div>
                <div style="margin-top:8px; font-size:11px; color:#1F2E23;">
                    <div style="margin-bottom:6px;">✓ Instalação rápida, em média 3 dias, sem obras</div>
                    <div>✓ Baixíssima manutenção — limpeza e verificações</div>
                </div>
                <br><br>
                <div style="font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#8FA98C;">Energia limpa e infinita</div>
                <div style="margin-top:8px; font-size:11px; color:#1F2E23;">
                    <div style="margin-bottom:6px;">✓ Energia 100% renovável</div>
                    <div style="margin-bottom:6px;">✓ Sem ruídos e sem emissão de gases poluentes</div>
                    <div>✓ Redução de impacto ambiental</div>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="body" style="font-family:sans-serif; color:#1F2E23;">
    <span style="font-family:serif; font-size:16px; color:#1B4332;">Serviços inclusos</span>
    <div style="width:24px; border-top:2px solid #C1622D; margin-top:6px; margin-bottom:10px;"></div>
    <div style="font-size:11px; color:#5B6F60;">
        1. Vistoria técnica e projeto elétrico do sistema.<br>
        2. Anotação da responsabilidade técnica (ART) do projeto e instalação.<br>
        3. Obtenção das licenças junto à concessionária de energia local.<br>
        4. Montagem dos módulos fotovoltaicos com estruturas apropriadas para o tipo de telhado/solo.<br>
        5. Instalação e montagem elétrica do sistema.<br>
        6. Gestão, supervisão e fiscalização da obra de instalação.<br>
        7. Frete incluso de todos os equipamentos referentes ao sistema.<br>
        8. Documentação personalizada do projeto fotovoltaico.<br>
        <span style="color:#8FA98C;">Obs.: não estão inclusos eventuais serviços de alvenaria, reforço estrutural, e/ou alterações na rede de distribuição as quais eventualmente podem ser solicitadas pela concessionária.</span>
    </div>

    <br>

    <span style="font-family:serif; font-size:16px; color:#1B4332;">Considerações finais e validade</span>
    <div style="width:24px; border-top:2px solid #C1622D; margin-top:6px; margin-bottom:10px;"></div>
    <div style="font-size:11px; color:#5B6F60;">
        1. Os valores apresentados de geração de energia são estimativas baseadas em informações consultadas no banco de dados do CRESESB,
        e representam médias mensais e anuais, sendo que a geração varia de acordo com os meses do ano, assim como de acordo com fatores meteorológicos.<br>
        2. As estimativas de geração de energia, custos e economia foram baseadas e projetadas de acordo com as informações de consumo apresentadas pelo cliente,
        o estudo de irradiação solar local e a análise da inflação energética nos últimos anos. O sistema proposto foi projetado considerando-se o atual perfil
        de consumo do cliente, tal como de acordo com os requisitos apresentados pelo cliente.<br>
        3. Por não possuir partes móveis, o sistema não exige manutenção preventiva. Periodicamente
        (6 meses a 1 ano), é recomendável a limpeza dos módulos fotovoltaicos para otimizar a geração de energia, especialmente em regiões/estações secas.
    </div>
</div>
