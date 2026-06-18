# Plano de Melhorias — Dimensionamento e Propostas Fotovoltaicas

Documento de acompanhamento da auditoria técnica e do plano de melhorias do motor de dimensionamento (`app/src/Orcamentos/Dimensionamento/`) e da emissão de propostas comerciais. Plano completo (5 fases) em `/home/ubuntu22/.claude/plans/gentle-shimmying-rose.md`. Achados detalhados da auditoria original em `docs/RELATORIO_DIMENSIONAMENTO_KITS.md`.

**Status geral: plano encerrado.** Todas as fases foram implementadas, exceto a 3.3, deliberadamente deixada pendente por exigir uma tabela de referência regulatória (PRODIST Módulo 3) que não deve ser fabricada sem confirmação — decisão explícita do usuário de não bloquear o encerramento por esse item.

## Status por fase

| Fase | Descrição | Status |
|---|---|---|
| 0 | Testes de caracterização | ✅ Feito (Convencional, Demanda, faixa de tolerância de kit, PR, razão DC/AC) |
| 1 | Correções de bugs reais (orientação, constante mágica) | ✅ Feito |
| 2 | Payback real, Fio B, decomposição de tarifa | ✅ Feito (versão simplificada — ver decisões abaixo) |
| 3 | PR decomposto, validação DC/AC | ✅ Feito (limite de tensão/PRODIST adiado — depende de tabela regulatória a confirmar) |
| 4 | Saneamento de código morto | ✅ Feito (`VariaveisCalculo`, `OffGrid` removidos) |
| 5 | Conformidade legal do PDF | ✅ Feito |

## O que foi implementado nesta rodada

### Fase 5 — Base legal do PDF corrigida
`resources/views/pages/pdf/solmar/sessoes/regulamentacao.blade.php` citava as REN ANEEL 482/2012 e 687/2015 como marco regulatório vigente — ambas foram **revogadas** pela REN ANEEL 1.059/2023 (que regulamenta a Lei 14.300/2022, Marco Legal da Geração Distribuída). Texto atualizado para citar a Lei 14.300/2022 e a REN 1.059/2023, com nota sobre o cronograma de cobrança do Fio B e referência técnica às normas NBR 16690/16274. Lei 13.169/2015 (PIS/COFINS) e LGPD mantidas, pois continuam válidas.

### Fase 1.1 — Perda por orientação do telhado aplicada ao cálculo
Bug confirmado: o admin configurava 4 percentuais de perda por orientação (`dados_dimensionamentos`, meta `orientacao_instalacao`), o formulário exigia o campo `orientacao`, mas nenhuma fórmula de cálculo lia esse valor — só alimentava um rótulo de texto na tela da proposta.

Correções:
- **Vocabulário unificado**: `App\src\Orcamentos\DirecaoInstalacao::direcoes()` usava a chave `sudeste_noroeste` (conceito sem sentido físico, mistura de pontos opostos), incompatível com a chave `sudeste_sudoeste` do admin. Corrigido para `nordeste_noroeste` / `sudeste_sudoeste`, alinhado ao admin. `norte` e `desconsiderar` não têm perda configurável (norte é a orientação ideal no hemisfério sul → perda 0).
- **Compatibilidade histórica**: `getDirecaoInstalacao()` (`app/Helpers/dimensionamento.php`) mantém a chave legada `sudeste_noroeste` só para exibir corretamente propostas já emitidas com esse valor — **decisão confirmada pelo usuário: não reprocessar dados antigos**, apenas exibi-los corretamente.
- **Novo método** `App\Models\DadosDimensionamento::getPerdaPorOrientacao(string $orientacao): float` — resolve o percentual de perda configurado para uma chave de orientação.
- `ConvencionalDados`/`DemandaDados` agora expõem `getPerdaOrientacao()`, lendo a perda configurada a partir do campo `orientacao` do formulário.
- `Convencional::calcularPotencia()`/`calcularGeracao()` e `Demanda::calcularPotencia()`/`calcularGeracao()` agora aplicam essa perda: reduz a irradiação efetiva no cálculo de potência (mesma forma da perda de sistema de 15%) e reduz a geração estimada proporcionalmente.

**Impacto esperado**: propostas novas com orientação desfavorável (Sul, Leste/Oeste, Sudeste/Sudoeste) agora calculam potência maior e geração estimada menor do que antes — refletindo a perda real, mas mudando os números mostrados ao vendedor/cliente em relação ao comportamento anterior. Propostas já emitidas não são afetadas.

### Fase 1.2 — Constante mágica documentada
A perda fixa de 15% (`* (1 - 0.15)`), hardcoded e sem nenhuma documentação no código, foi extraída para `Convencional::PERDA_SISTEMA_PADRAO` / `Demanda::PERDA_SISTEMA_PADRAO`, com docblock explicando sua origem e a distinção em relação à `margem_perda` administrativa. Refactor puro, sem mudança de comportamento — prepara a Fase 3 (decomposição em Performance Ratio configurável).

### Fase 4 — Código morto removido
- `app/src/Orcamentos/Dimensionamento/VariaveisCalculo.php` — nunca instanciada em nenhum lugar do código, removida.
- `app/src/Orcamentos/Dimensionamento/OffGrid/OffGrid.php` e `OffGridDados.php` — importavam uma classe inexistente (`XDimensionamento`), não implementavam nenhum método abstrato exigido, nunca referenciados em rota/view. **Decisão confirmada pelo usuário: remover** (não há demanda comercial por dimensionamento off-grid hoje; se surgir, será um projeto novo, com DTO e fórmula de autonomia/banco de baterias completamente diferentes).

### Fase 0 — Testes de caracterização
Criados em `tests/Unit/Orcamentos/Dimensionamento/`:
- `Convencional/ConvencionalTest.php` — fórmula de potência (override manual, cálculo por consumo, efeito da perda de orientação, efeito da margem administrativa) e geração.
- `Demanda/DemandaTest.php` — consumo ponderado pelo fator de carga ponta/fora-ponta, efeito da perda de orientação na potência e na geração.
- `Kits/SelecionarKitsDBTest.php` — faixa de tolerância de potência na seleção de kit (100%/10%/5%/3% conforme a faixa).

Todos usam DTOs fake (sem tocar banco) para isolar a fórmula. 12 testes, 17 assertions, todos passando. Os 2 testes de feature pré-existentes que já falhavam antes desta mudança (`CadastrarOrcamentoTest`, `DimenConvencionalTest` — `qtd_kits`/`preco_cliente` nulos por não serem setados no teste) continuam com a mesma falha pré-existente, não relacionada a esta rodada.

### Fase 3.1 — Performance Ratio (PR) decomposto, substituindo o 15% fixo
A perda fixa de 15% hardcoded (`Convencional`/`Demanda`) foi substituída por um PR composto a partir de 6 fatores configuráveis pelo admin (temperatura, sujeira, sombreamento, cabeamento, mismatch, degradação inicial/LID), que se compõem **multiplicativamente** (não somam — mesma lógica usada por ferramentas de simulação como PVsyst).

- Nova classe pura `App\src\Orcamentos\Dimensionamento\PerformanceRatio::compor(array $perdasPercentuais): float`.
- `App\Models\DadosDimensionamento` ganhou os 6 getters/setters EAV (meta `performance_ratio`) e o método `getPerformanceRatio()`.
- `ConvencionalDados`/`DemandaDados` expõem `getPerformanceRatio()`; `Convencional`/`Demanda` consomem esse valor no lugar da constante fixa.
- **Migration de seed** (`2026_06_18_054615_seed_performance_ratio_dados_dimensionamentos.php`) calibrou os 6 valores padrão (temperatura 5,5%, sujeira 3,2%, cabeamento 2,4%, sombreamento 1,9%, mismatch 1,6%, degradação inicial 1,3%) para que o PR composto resultante seja ≈0,85 — **decisão confirmada pelo usuário: preservar o número atual no dia do deploy**, sem mudar potência/preço das propostas novas nesta rodada. Verificado em runtime: PR = 0,8506.
- UI admin (`pages/admin/configs/dimensionamento/index.blade.php`) ganhou uma seção "Performance Ratio" com os 6 campos e o PR composto atual exibido, para recalibração futura orientada por dados reais de geração medida.

### Fase 3.2 — Alerta de razão DC/AC fora da faixa de mercado
Nova classe `App\src\Orcamentos\Dimensionamento\Kits\RazaoDcAc` calcula a razão entre a potência do arranjo de painéis e a potência do inversor de cada kit sugerido. **Decisão confirmada pelo usuário: alertar, não bloquear** — kits fora da faixa 1.0–1.3 continuam aparecendo na lista, mas com um badge de aviso (`lista-kits.blade.php`, componente compartilhado pelos fluxos Convencional e Demanda).

### Fase 3.3 — Adiada
O alerta de limite de potência por classe de tensão (PRODIST Módulo 3) não foi implementado nesta rodada: exigiria uma tabela de referência tensão→potência máxima que não deve ser fabricada sem confirmação — os limites variam por concessionária dentro do que o PRODIST permite como teto. Fica pendente de uma fonte de dados confirmada pelo usuário.

### Fase 2 — Payback real (maior achado da auditoria)

O gráfico de payback exibido na proposta (`payback-fotovoltaico.blade.php`) usava coeficientes hardcoded em JS (`precoCliente / -1.1666` etc.), sem nenhuma relação com tarifa, geração ou Fio B reais. Substituído por um motor de fluxo de caixa real, com 3 decisões de produto confirmadas pelo usuário antes de codificar:

- **2.1 — Schema de tarifa: Opção A (simplificada)**. Em vez de decompor TE/TUSD por concessionária (`Concessionarias` não foi alterada), o Fio B é estimado como um **percentual configurável da tarifa cheia** (`fio_b_percentual_tarifa`, padrão 25%, ajustável pelo admin). Menos preciso por concessionária, mas evita manutenção contínua de tarifas reais.
- **2.2 — Concessionária no fluxo Convencional: derivada automaticamente pelo estado, sem opção de troca**. Novo `App\Models\Concessionarias::porEstado($sigla)` retorna a concessionária de menor `id` cadastrada naquele estado (estados com múltiplas distribuidoras — SC tem 27, SP e RS têm 19 cada — usam uma aproximação, sem seleção manual exposta ao vendedor).
- **2.3 — Inflação energética padrão: 8% a.a.** (meio-termo da faixa de mercado 6–10%), configurável pelo admin, sempre exibida como estimativa.

**Novo namespace `App\src\Orcamentos\Financeiro\`:**
- `FioB.php` — cronograma legal 2023→2029 (15/30/45/60/75/90/100%) como constante documentada (Lei 14.300/2022, REN 1.059/2023), com regra de direito adquirido (acesso solicitado antes de 7/1/2023 = 0% para sempre).
- `DegradacaoPainel.php` — fator de geração restante por ano (degradação LID no 1º ano + degradação linear anual a partir do 2º).
- `InflacaoEnergetica.php` — fator de reajuste tarifário composto por ano.
- `DadosFluxoCaixa.php` — DTO de entrada.
- `FluxoCaixaSolar.php` — orquestra os três anteriores ano a ano (1–25): geração degradada × tarifa reajustada = economia bruta, menos o custo do Fio B (economia bruta × percentual configurado × percentual do cronograma do ano calendário), produzindo saldo acumulado real (investimento como saída única no ano 0) e `anoPayback()` com interpolação dentro do ano em que o saldo cruza zero.

**Novas configurações em `App\Models\DadosDimensionamento`** (EAV, meta `financeiro`): `getDegradacaoAno1`/`getDegradacaoAnual`/`getInflacaoEnergetica`/`getFioBPercentualTarifa` + setters, com seed (`2026_06_18_062345_seed_financeiro_dados_dimensionamentos.php`: degradação 2,0%/0,55%, inflação 8%, Fio B 25%) e nova seção "Premissas Financeiras (Payback)" em `/admin/configs/dimensionamento`.

**Substituição do gráfico**: `App\View\Components\Graficos\PaybackFotovoltaico` agora recebe `geracao`, `cidade` e `dataOrcamento` (além de `precoCliente`), computa o fluxo de caixa real internamente (mesmo padrão server-side já usado por `GeracaoFotovoltaica` — sem precisar de endpoint AJAX novo) e passa o array pronto para o JS via `@json`, eliminando os coeficientes mágicos. Mantida intacta a mecânica de captura `chart.getImageURI()` → input hidden `#grafico_payback` → PDF. Os 4 call sites (`admin/orcamentos/show`, `vendedor/orcamentos/show`, `vendedor/orcamentos/externa/index`, `pdf/solmar/pagina_1`) foram atualizados para passar os novos atributos. Adicionada legenda abaixo do gráfico com o payback estimado e disclaimer das premissas assumidas (degradação, inflação, Fio B — não constitui garantia).

**Testes**: `tests/Unit/Orcamentos/Financeiro/` — `FioBTest`, `DegradacaoPainelTest`, `InflacaoEnergeticaTest`, `FluxoCaixaSolarTest` (15 testes). Verificado também end-to-end contra um orçamento real do banco: payback calculado em 4,3 anos (antes, o número era inteiramente fictício).

**Simplificações assumidas (documentar para a equipe)**: 100% da geração é tratada como injetada/compensada (não modela autoconsumo instantâneo por curva de carga horária); a tarifa usada é a `convencional` da concessionária derivada do estado (não a tarifa real contratada pelo cliente); o percentual de Fio B sobre a tarifa é uma estimativa nacional única, não por concessionária.

## Pendente (não bloqueia o encerramento do plano — retomar só se houver demanda futura)

- **Fase 3.3**: limite de potência por classe de tensão (PRODIST) — precisa de tabela de referência confirmada antes de codificar. Usuário optou por encerrar o plano sem implementar este item.
- **Evolução futura da Fase 2** (não solicitada agora, registrar para referência): se o volume de propostas justificar, considerar Opção B/C de decomposição de tarifa (TE/TUSD reais por concessionária) e captura manual de concessionária no fluxo Convencional, para maior precisão por cliente.
