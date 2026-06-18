# Relatório — Lógica de Dimensionamento de Kits (Propostas Comerciais)

Análise da engine de dimensionamento usada pelos vendedores ao montar uma proposta (`app/src/Orcamentos/Dimensionamento/`).

## 1. Arquitetura geral

Padrão Strategy + DTO:

- **`Dimensionamento`** (abstrato) — contrato comum: `calcularGeracao()`, `selecionarKits()`, `calcularPotencia()` (protegido), getters de potência/tensão/estrutura/estado/qtdKits/incluirTrafo.
- **`DadosDimensionamento`** — interface vazia, apenas marca os DTOs de entrada.
- Duas implementações concretas e funcionais: **Convencional** e **Demanda**. Uma terceira, **OffGrid**, existe só de nome (ver §5).

Fluxo por tipo (idêntico nos dois): `Controller@index` (formulário) → `Controller@create` (recebe o Request, instancia `XxxDados` + `Xxx`, chama `selecionarKits()`, devolve a lista de kits via AJAX) → `Controller@store` (persiste a proposta com `Orcamento::cadastrar()`).

## 2. Cálculo da potência necessária

### Convencional (`Convencional.php` + `ConvencionalDados.php`)

Entrada: cliente, cidade, estrutura, tensão, orientação, e **ou** `consumo` **ou** `potencia` (kWp manual) — a validação (`ConvencionalRequest`) exige `consumo` apenas se `potencia` não foi informada.

```php
if ($this->potenciaKWP) {
    $this->potencia = $this->potenciaKWP;               // override manual
} else {
    $resultado = ($this->consumo / 30) / ($this->irradiacao * (1 - 0.15));
    $resultado = $resultado * (1 + $this->correcao / 100);
    $this->potencia = round($resultado, 3);
}
```

- `irradiacao` = média de irradiação solar da cidade (`IrradiacaoSolar::find($cidade, 'media')->media`).
- `0.15` = perda fixa de 15% embutida no código (system losses), **hardcoded**, não configurável.
- `correcao` = "margem de perda" configurável via admin (tabela `dados_dimensionamentos`, `meta=ajuste_calculo`, `meta_key=margem_perda`), aplicada como um acréscimo percentual sobre o resultado.

### Demanda (`Demanda.php` + `DemandaDados.php`)

Mesma fórmula, mas o consumo de entrada é uma **média ponderada pelo fator de carga** entre consumo ponta/fora-ponta da concessionária:

```php
$fc = $this->tarifas->ponta / $this->tarifas->fora_ponta;
$mediaConsumo = $this->consumoForaPonta + ($fc * $this->consumoPonta);
$resultado = ($mediaConsumo / 30) / ($this->irradiacao * (1 - 0.15));
$resultado = $resultado * (1 + $this->correcao / 100);
$this->potencia = round($resultado, 3);
```

Não existe aqui a opção de informar potência manual (sem override de kWp) — o cliente é sempre dimensionado a partir do consumo ponta/fora-ponta.

### Geração estimada (ambos os tipos, fórmula idêntica)

```php
public function calcularGeracao(float $potenciaKit): float
{
    return $this->irradiacao * 30 / (1 + $this->correcao / 100) * $potenciaKit;
}
```

Geração mensal estimada por kWp instalado, usando a mesma irradiação/correção da cidade.

## 3. Seleção de kits (`Kits/SelecionarKitsDB.php`)

Dado a potência necessária (dividida pela quantidade de kits desejada) e a estrutura, busca kits dentro de uma **faixa de tolerância de potência** que se estreita conforme a potência cresce:

| Potência (kWp) | Tolerância |
|---|---|
| ≤ 1 | 100% |
| > 1 | 10% |
| > 3 | 8% |
| > 10 | 5% |
| > 20 | 3% |

```php
$min = $potencia * (1 - $variacaoPot/100);
$max = $potencia * (1 + $variacaoPot/100);
```

Filtra por `estrutura`, `status = true` e `status_fornecedor = true`, ordenado por `preco_fornecedor ASC` (kit mais barato primeiro). **A tensão (`tensao`) não é filtrada nesta query** — ela só entra depois, na lógica de transformador.

`SelecionarKits.php` agrupa o resultado por marca de inversor → marca de painel → faixa de potência, para exibição na tela de escolha do vendedor.

## 4. Preço de venda — 5 margens em camadas (`Kits/CalculaPrecoVenda.php`)

```php
$item->preco_cliente = $item->preco_fornecedor * $qtdKits *
    (1 + (getMargemPrincipal($item->id)
        + $margemVendedor
        + $margemEstrutura
        + $margemEstado
        + $margemFornecedor) / 100);
```

As margens são somadas (não compostas) e cada uma vem de uma fonte diferente, via `PrecificacaoMetas` (EAV `meta`/`meta_key`/`value`):

1. **Principal** — `getMargemPrincipal($id)`, por faixa de potência do kit.
2. **Vendedor** — `getVendedor(id_usuario_atual())`, margem do consultor logado.
3. **Estrutura** — `getEstrutura($id)`, por tipo de estrutura de fixação.
4. **Estado** — `getEstado($estado)`, por UF do cliente.
5. **Fornecedor** — `getFornecedor($id)`, por fornecedor do kit.

### Transformador automático (`SelecionaTrafo*.php`)

Se a tensão do kit (`$item->tensao`) for maior que a tensão solicitada pelo cliente, o sistema busca o trafo mais barato ativo com `potencia > potencia_kit * 1.1` e soma o `preco_cliente` do trafo ao preço final do kit.

## 5. Achados — código morto / inconsistências

- **`VariaveisCalculo.php`** — classe com propriedades de margem de perda, sobra de potência e perdas por orientação (NE/NO, LO, SE/SO, Sul), todas inicializadas como string vazia. **Não é instanciada em nenhum lugar do código.** Morta.

- **`OffGrid` / `OffGridDados`** — terceiro tipo de dimensionamento previsto na arquitetura, mas **nunca implementado**: `OffGrid.php` importa uma classe `XDimensionamento` que **não existe** no projeto, e a classe não implementa nenhum dos métodos abstratos exigidos por `Dimensionamento`. Se instanciada, falharia (erro fatal de classe abstrata incompleta / import inexistente). Nenhuma rota, controller ou view referencia essas classes — não há fluxo de proposta off-grid disponível hoje, apesar do nome sugerir que era planejado.

- **Campo `orientacao` (direção da instalação) — coletado mas não usado no cálculo.** É obrigatório nos dois formulários (Convencional e Demanda), e existe configuração de admin para perdas por orientação (NE/NO, LO, SE/SO, Sul) na tabela `dados_dimensionamentos`. Porém:
  - Nenhuma classe em `app/src/Orcamentos/Dimensionamento/` lê esse valor para ajustar potência ou geração.
  - O único uso encontrado de `orientacao` no sistema é **puramente de exibição**: a tela de visualização da proposta (`resources/views/pages/{admin,vendedor}/orcamentos/show.blade.php`) mostra a label `getDirecaoInstalacao($metas['orientacao'])` na tabela de dados da proposta.
  - Ou seja: o vendedor é obrigado a informar a direção do telhado, o admin pode configurar percentuais de perda por orientação, mas esses percentuais **nunca afetam o dimensionamento real** — é uma informação decorativa que sugere uma feature de perda por orientação planejada e nunca conectada à fórmula de cálculo.

- **Perda de sistema de 15% hardcoded** (`* (1 - 0.15)`) em ambas as fórmulas (Convencional e Demanda) — não é configurável via admin, ao contrário da "margem de perda" (`correcao`), que é EAV. Se a intenção for permitir ajuste fino de perdas do sistema, esse valor fixo está fora do alcance da tela de configuração.

- **Seleção de kit não filtra por tensão na query** — a tensão do cliente só é usada depois, para decidir se entra trafo. Um kit fora da tensão pedida ainda pode ser sugerido ao vendedor (com custo adicional de trafo) sem nenhuma sinalização na query original; o filtro é puramente posterior à seleção dos kits por potência.

## 6. Resumo executivo

| Item | Convencional | Demanda |
|---|---|---|
| Entrada principal | Consumo mensal OU potência manual (kWp) | Consumo ponta + fora-ponta + tarifas da concessionária |
| Fórmula | `(consumo/30) / (irrad*0.85) * (1+correcao/100)` | `(consumoPonderado/30) / (irrad*0.85) * (1+correcao/100)` |
| Override manual de potência | Sim | Não |
| Geração estimada | `irrad*30/(1+correcao/100)*potKit` | idêntica |
| Seleção de kit | Faixa de tolerância por potência, mais barato primeiro | idêntica |
| Preço de venda | 5 margens somadas (principal, vendedor, estrutura, estado, fornecedor) | idêntica |
| Orientação do telhado | Coletada, **não usada no cálculo** | idêntica |
| Off-grid | Não implementado / inacessível | — |
