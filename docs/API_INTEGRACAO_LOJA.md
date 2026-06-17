# API de Sincronização de Produtos — AppSolar → Loja Online

Este documento descreve a API REST exposta pelo **AppSolar** (CRM/ERP solar) para que a
**loja online** consuma e sincronize seu catálogo de produtos. É destinado a quem vai
implementar o lado consumidor (cliente HTTP) na loja — incluindo agentes de IA como o
Claude Code, que podem usar este documento como especificação completa para gerar o
serviço de integração sem precisar inspecionar o código-fonte do AppSolar.

> ⚠️ **Placeholder de domínio:** todos os exemplos abaixo usam
> `https://<host-do-appsolar>` como espaço reservado para a URL real de produção do
> AppSolar. Substitua por todo o documento antes de usar os exemplos literalmente —
> o domínio definitivo ainda não foi informado.

## Visão geral

- **Fornece:** catálogo de kits de energia solar fotovoltaica, já com preço de venda
  calculado, imagens de marca e dados técnicos.
- **Fornecedor único disponível:** apenas produtos do fornecedor **Edeltec** são
  retornados (outros fornecedores são legados/descontinuados e nunca aparecem na API).
- **Filtro automático e obrigatório:** só retorna produtos com `status` ativo,
  `status_fornecedor` ativo, e que possuam SKU preenchido. Produtos inativos ou sem SKU
  nunca aparecem — nem na listagem, nem na busca direta.
- **Formato:** JSON, REST, somente leitura (`GET`). Não há endpoints de escrita.
- **Base URL:** `https://<host-do-appsolar>/api/v1/loja` (em ambiente local de
  desenvolvimento: `http://localhost:8000/api/v1/loja`).

## Autenticação

Todas as rotas exigem um **Bearer token estático** enviado no header `Authorization`:

```
Authorization: Bearer <LOJA_API_TOKEN>
```

- O token é uma string fixa, configurada no lado do AppSolar (`.env` →
  `LOJA_API_TOKEN`, `config/services.php` → `services.loja.api_token`). Solicite o
  valor atual ao time do AppSolar — não é gerado pela loja.
- Não há expiração nem renovação automática (não é OAuth/JWT). Se o token for rotacionado
  no AppSolar, a loja precisa atualizar a configuração manualmente.
- Requisição sem token, com token vazio, ou com token incorreto retorna `401`.
- Cada chamada (autorizada ou não) é registrada em um histórico de auditoria no AppSolar
  (IP, rota, parâmetros, SKU consultado e status HTTP retornado).

## Configuração no `.env` da loja

O lado consumidor (loja) **não deve hardcodar** a URL base nem o token da API no código.
Adicione no `.env` da loja (e no `.env.example`, sem o valor real) as seguintes
variáveis:

```env
# URL base da API do AppSolar (sem barra final, sem o /produtos)
APPSOLAR_API_BASE_URL=https://<host-do-appsolar>/api/v1/loja

# Token de autenticação fornecido pelo time do AppSolar
APPSOLAR_API_TOKEN=<solicitar ao time do AppSolar>
```

- `APPSOLAR_API_BASE_URL`: em produção, deve apontar para o domínio real do AppSolar
  (ex.: `https://crm.suaempresa.com.br/api/v1/loja`). Em desenvolvimento/homologação,
  use a URL correspondente do ambiente de teste do AppSolar, se houver, ou
  `http://localhost:8000/api/v1/loja` ao testar contra uma instância local.
- `APPSOLAR_API_TOKEN`: mesmo valor configurado em `LOJA_API_TOKEN` no `.env` do
  AppSolar — precisa ser solicitado ao time responsável pelo AppSolar, não é gerado
  pela loja.
- Construa as chamadas concatenando `APPSOLAR_API_BASE_URL` com o path do endpoint
  (ex.: `${APPSOLAR_API_BASE_URL}/produtos`, `${APPSOLAR_API_BASE_URL}/produtos/{sku}`),
  em vez de fixar o domínio em qualquer lugar do código.
- Se a loja tiver ambientes separados (local/staging/produção), cada um deve ter seu
  próprio `.env` com a `APPSOLAR_API_BASE_URL` e `APPSOLAR_API_TOKEN` correspondentes
  àquele ambiente do AppSolar.

## Endpoints

### 1. Listar produtos

```
GET /api/v1/loja/produtos
```

Retorna uma lista paginada de produtos.

**Query params (todos opcionais):**

| Parâmetro            | Tipo               | Padrão | Descrição                                                                 |
|-----------------------|--------------------|--------|----------------------------------------------------------------------------|
| `per_page`            | inteiro (1–200)     | `50`   | Quantidade de itens por página.                                           |
| `atualizados_desde`   | data (`YYYY-MM-DD` ou ISO 8601) | —      | Retorna só produtos com `atualizado_em >=` a data informada — use isso para sincronização incremental (delta sync). |
| `page`                | inteiro             | `1`    | Página da paginação (padrão do Laravel — gerado automaticamente nos links de resposta). |

**Exemplo de requisição:**

```bash
curl -s \
  -H "Authorization: Bearer SEU_TOKEN_AQUI" \
  "https://<host-do-appsolar>/api/v1/loja/produtos?per_page=50&atualizados_desde=2026-06-01"
```

**Exemplo de resposta (`200 OK`):**

```json
{
    "data": [
        {
            "sku": "278327",
            "nome": "Gerador solar deye 2,22 kwp mon. 220v s/estrutura (3k/555w)",
            "potencia_kit_kwp": 2.22,
            "tensao": "220",
            "preco_custo": 3806.31,
            "preco_venda": 5519.15,
            "disponivel": true,
            "marca_inversor": "DEYE (Convencional)",
            "marca_inversor_logo": "https://<host-do-appsolar>/storage/produtos/D3kJ....jpg",
            "marca_inversor_imagem": "https://<host-do-appsolar>/storage/produtos/rjnE....jpg",
            "potencia_inversor": 3,
            "marca_painel": "Jinko",
            "marca_painel_logo": "https://<host-do-appsolar>/storage/produtos/i4sh....jpg",
            "marca_painel_imagem": "https://<host-do-appsolar>/storage/produtos/MktE....png",
            "potencia_painel": 555,
            "estrutura": "Sem Estrutura",
            "fornecedor": "EDELTEC",
            "componentes": "<table><tr><th>Sku</th><th>Quantidade</th><th>Descrição</th></tr>...</table>",
            "observacoes": null,
            "atualizado_em": "2024-07-29T12:24:53-03:00"
        }
    ],
    "links": {
        "first": "https://<host-do-appsolar>/api/v1/loja/produtos?page=1",
        "last": "https://<host-do-appsolar>/api/v1/loja/produtos?page=30662",
        "prev": null,
        "next": "https://<host-do-appsolar>/api/v1/loja/produtos?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 30662,
        "path": "https://<host-do-appsolar>/api/v1/loja/produtos",
        "per_page": 50,
        "to": 50,
        "total": 61324
    }
}
```

> O envelope `links`/`meta` é o formato padrão de paginação do Laravel. `meta.total` é o
> total de produtos que atendem ao filtro atual (ativos + com SKU + Edeltec). Use
> `meta.last_page` para saber quando parar de paginar.

### 2. Buscar um produto por SKU

```
GET /api/v1/loja/produtos/{sku}
```

**Exemplo:**

```bash
curl -s \
  -H "Authorization: Bearer SEU_TOKEN_AQUI" \
  "https://<host-do-appsolar>/api/v1/loja/produtos/278327"
```

**Resposta (`200 OK`):**

```json
{
    "data": {
        "sku": "278327",
        "nome": "Gerador solar deye 2,22 kwp mon. 220v s/estrutura (3k/555w)",
        "potencia_kit_kwp": 2.22,
        "tensao": "220",
        "preco_custo": 3806.31,
        "preco_venda": 5519.15,
        "disponivel": true,
        "marca_inversor": "DEYE (Convencional)",
        "marca_inversor_logo": "https://<host-do-appsolar>/storage/produtos/D3kJ....jpg",
        "marca_inversor_imagem": "https://<host-do-appsolar>/storage/produtos/rjnE....jpg",
        "potencia_inversor": 3,
        "marca_painel": "Jinko",
        "marca_painel_logo": "https://<host-do-appsolar>/storage/produtos/i4sh....jpg",
        "marca_painel_imagem": "https://<host-do-appsolar>/storage/produtos/MktE....png",
        "potencia_painel": 555,
        "estrutura": "Sem Estrutura",
        "fornecedor": "EDELTEC",
        "componentes": "<table>...</table>",
        "observacoes": null,
        "atualizado_em": "2024-07-29T12:24:53-03:00"
    }
}
```

Se o SKU não existir, estiver inativo, ou pertencer a outro fornecedor, a resposta é
`404` (ver seção de erros).

## Dicionário de campos do produto

| Campo                    | Tipo            | Descrição                                                                                   |
|---------------------------|-----------------|------------------------------------------------------------------------------------------------|
| `sku`                      | string          | Código único do produto. Use como chave de sincronização (upsert) no banco da loja.          |
| `nome`                     | string          | Nome/descrição comercial do kit.                                                              |
| `potencia_kit_kwp`         | number          | Potência total do kit gerador, em kWp.                                                        |
| `tensao`                   | string          | Tensão de saída (ex.: `"220"`, `"127"`).                                                      |
| `preco_custo`               | number          | Preço de custo (fornecedor). **Informação sensível** — não exiba publicamente na loja, é só para cálculo interno de margem. |
| `preco_venda`               | number          | Preço de venda sugerido, já calculado (`preco_custo × (1 + margem%)`). Use este para exibir ao cliente final. |
| `disponivel`                | boolean         | `true` se o produto está ativo e disponível no fornecedor. Produtos indisponíveis nunca aparecem na API de qualquer forma — este campo é redundante/sempre `true` hoje, mas mantenha o tratamento para o futuro. |
| `marca_inversor`            | string\|null    | Nome da marca/modelo do inversor.                                                              |
| `marca_inversor_logo`       | string (URL)\|null | URL absoluta da logo da marca do inversor.                                                 |
| `marca_inversor_imagem`     | string (URL)\|null | URL absoluta da foto do produto (inversor).                                                |
| `potencia_inversor`         | number          | Potência do inversor, em kW.                                                                   |
| `marca_painel`              | string\|null    | Nome da marca/modelo do painel solar.                                                          |
| `marca_painel_logo`         | string (URL)\|null | URL absoluta da logo da marca do painel.                                                   |
| `marca_painel_imagem`       | string (URL)\|null | URL absoluta da foto do produto (painel).                                                  |
| `potencia_painel`           | number          | Potência de cada painel, em Watts.                                                            |
| `estrutura`                 | string\|null    | Tipo de estrutura de fixação (ex.: "Telha Colonial", "Solo", "Sem Estrutura").                |
| `fornecedor`                 | string          | Sempre `"EDELTEC"` atualmente.                                                                |
| `componentes`                | string (HTML)   | Tabela HTML (`<table>...</table>`) com a lista de itens que compõem o kit (SKU interno, quantidade, descrição). Trate como HTML/texto livre, não como JSON estruturado. |
| `observacoes`                | string\|null    | Observações gerais do produto.                                                                |
| `atualizado_em`              | string (ISO 8601) | Data/hora da última atualização no AppSolar. Use para sincronização incremental e para decidir se precisa atualizar o registro local. |

**Observações importantes para quem for implementar o consumidor:**

- `marca_inversor_logo`, `marca_inversor_imagem`, `marca_painel_logo` e
  `marca_painel_imagem` podem vir `null` quando a marca correspondente não tem imagem
  cadastrada no AppSolar. Trate `null` graciosamente (ex.: exibir uma imagem placeholder).
- `componentes` é HTML simples (uma tabela), pensado para ser embutido direto numa página
  de produto. Caso a loja precise dos dados estruturados (SKU interno + quantidade +
  descrição de cada item do kit), terá que fazer parsing do HTML — não há um campo JSON
  estruturado para isso hoje.
- Não existe campo de estoque/quantidade disponível — `disponivel` é a única indicação de
  disponibilidade.
- Os preços (`preco_custo`, `preco_venda`) são `float`, já em Reais (BRL), sem
  formatação/moeda — formate na loja conforme necessário.

## Estratégia de sincronização recomendada

1. **Sincronização completa (full sync):** percorra `GET /produtos?per_page=200` página a
   página (usando `links.next` até virar `null`) e faça upsert por `sku` no banco da loja.
   Recomendado rodar isso uma vez na configuração inicial, ou periodicamente (ex.: 1x por
   dia) como rede de segurança.
2. **Sincronização incremental (delta sync):** guarde a data/hora da última sincronização
   bem-sucedida e, na próxima rodada, chame
   `GET /produtos?atualizados_desde=<ultima_sync>&per_page=200`. Isso retorna só os
   produtos que mudaram desde então — muito mais rápido para rodar com frequência (ex.:
   de 15 em 15 minutos ou de hora em hora).
3. **Produtos que saem do catálogo:** a API nunca informa exclusões explicitamente. Se um
   produto deixou de ser retornado em uma sincronização completa (comparado à rodada
   anterior), trate como "descontinuado" e desative-o no catálogo da loja (não foi
   atualizado porque ficou inativo ou sem SKU no AppSolar).
4. Use o `sku` como chave de unicidade/upsert — é estável e único por produto.

## Erros e códigos de status

Todas as respostas de erro são JSON (mesmo que o cliente não envie
`Accept: application/json`).

| Status | Quando ocorre                                                                 | Corpo de exemplo |
|--------|----------------------------------------------------------------------------------|-------------------|
| `401`  | Token ausente, vazio ou inválido.                                                | `{"message": "Não autorizado."}` |
| `404`  | SKU não encontrado (inexistente, de outro fornecedor, inativo ou sem SKU).        | `{"message": "Produto não encontrado."}` |
| `422`  | Parâmetro de query inválido (ex.: `atualizados_desde` não é uma data válida, ou `per_page` fora do intervalo 1–200). | `{"message": "The atualizados desde is not a valid date.", "errors": {"atualizados_desde": ["The atualizados desde is not a valid date."]}}` |
| `429`  | Limite de requisições excedido (rate limit padrão: 60 requisições/minuto por IP/usuário). | `{"message": "Too Many Attempts."}` |
| `200`  | Sucesso.                                                                          | — |

**Recomendação para o cliente HTTP da loja:**
- Trate `401` como erro de configuração (token errado) — não fica resolvido tentando de
  novo, precisa corrigir o token.
- Trate `404` em `GET /produtos/{sku}` como "produto não existe mais ativamente" — não é
  necessariamente um erro do cliente.
- Trate `429` com backoff/retry (ex.: esperar e tentar de novo), respeitando o limite de
  60 req/min.
- Implemente timeout e retry com backoff exponencial para erros de rede/`5xx` (sem
  garantia de idempotência adicional necessária, pois todos os endpoints são `GET`).

## Limites e comportamento

- **Rate limit:** 60 requisições por minuto (padrão do AppSolar para toda a API).
- **Paginação:** `per_page` máximo é `200`. Para uma sincronização completa rápida, use
  `per_page=200` e pagine sequencialmente.
- **Somente leitura:** não há endpoints `POST`/`PUT`/`DELETE` — a loja não envia dados
  para o AppSolar através desta API, apenas consome.
- **Escopo fixo:** a API sempre filtra por fornecedor Edeltec + ativo + com SKU. Não há
  parâmetro para alterar esse comportamento.

## Resumo rápido para implementação (checklist)

- [ ] Criar `APPSOLAR_API_BASE_URL` e `APPSOLAR_API_TOKEN` no `.env` (e a entrada
      correspondente, sem valor, no `.env.example`) da loja — nunca hardcodar domínio
      ou token no código.
- [ ] Cliente HTTP envia `Authorization: Bearer <token>` em toda requisição.
- [ ] Implementar paginação seguindo `links.next` até `null`, ou iterando `page` até
      `meta.last_page`.
- [ ] Upsert no banco da loja usando `sku` como chave única.
- [ ] Guardar `atualizado_em` (ou timestamp da última sincronização) para usar
      `atualizados_desde` na próxima chamada incremental.
- [ ] Mapear `preco_venda` para o preço exibido ao cliente final; manter `preco_custo`
      apenas para uso interno (margem/relatórios), nunca exposto publicamente na loja.
- [ ] Tratar `marca_*_logo` / `marca_*_imagem` nulos com fallback visual.
- [ ] Tratar `401`, `404`, `422` e `429` conforme a tabela de erros acima.
- [ ] Respeitar rate limit de 60 req/min (espaçar chamadas de paginação se necessário).
