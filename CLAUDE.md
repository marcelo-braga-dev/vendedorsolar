# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this project is

**AppSolar** is a B2B solar energy CRM and quoting platform (Laravel 12, PHP 8.2). It manages the full sales pipeline: leads → quotes (orçamentos) → contracts → technical visits → installations. Two distinct user roles drive separate UI areas: **Admin** and **Vendedor** (salesperson).

## Development commands

```bash
# Start all services (MySQL + phpMyAdmin + app)
./vendor/bin/sail up -d

# Stop services
./vendor/bin/sail down

# Frontend assets (watch mode)
npm run watch

# Frontend assets (production build)
npm run prod

# Run migrations
php artisan migrate

# Run the Edeltec integration manually
php artisan app:integracao-edeltec

# Run tests
php artisan test

# Run a single test file
php artisan test tests/Feature/ExampleTest.php
```

The Edeltec supplier integration is scheduled to run daily at 04h via `app/Console/Kernel.php`.

## Architecture

### Request flow

Routes → Controller (Admin or Vendedor) → `app/src/` service classes → Models → Blade views

### Role system

Three user types defined in `app/src/Usuarios/`: `Admin`, `Vendedor`, `AdminVendedor`. Middleware `auth.admin` / `auth.vendedor` (in `app/Http/Middleware/Auth/`) gate the two route groups. Routes are split: `routes/web.php` includes `routes/users/index.php` for auth-protected routes, then loads `routes/db/index.php` for AJAX/DB helpers.

### Controllers

```
app/Http/Controllers/
  Admin/       — Configuracoes, Contratos, Financeiros, Fornecedores,
                 Integracoes, Leads, Orcamentos, Perfil, Precificacoes,
                 Produtos, Usuarios
  Vendedor/    — Clientes, Contratos, Financeiros, Mensagens, Orcamentos,
                 Perfil, Visitas
  Api/         — EnderecoController, LeadsController, OrcamentoApiController
  PDFOrcamentoController.php
```

### Business logic (`app/src/`)

Domain logic lives here, not in controllers or models.

- **`Orcamentos/Dimensionamento/`** — Solar system sizing engine. `Dimensionamento` is an abstract base; concrete types are `Convencional`, `Demanda`, `OffGrid`. `DadosDimensionamento` is the value-object input DTO.
- **`Orcamentos/Status/`** — State machine for quote lifecycle: Novo → Aprovado → Assinado → Instalando → Finalizado (plus `AprovacaoReprovada`).
- **`PDF/`** — PDF proposal generation via mPDF. `GerarPDF` delegates to `Solmar\Construtor` (there is also an unused `Ecovolt\Construtor`). Each brand has `Layout`, `Body`, `Sessoes`, `Servicos`, and `DadosOrcamento` sub-classes.
- **`Produtos/CalculoPrecos/`** — Sell-price calculation with layered margins.
- **`Precificacao/`** — Margin rules per state, structure type, supplier, and salesperson.
- **`Integracoes/Aldo/`** — Aldo distributor product catalog sync (ZIP/XML).
- **`Usuarios/`** — Role resolution helpers.

### Frontend

Blade templates with Bootstrap 5 + Vue 2 components via Laravel Mix (`webpack.mix.js`). JS entry point: `resources/js/app.js`. No full SPA — mostly server-rendered Blade with sprinkles of Vue. `tightenco/ziggy` exposes named Laravel routes to JS.

### Key helpers (`app/helpers.php` + `app/Helpers/`)

Global helpers auto-loaded by Composer: `convert_money_float()`, `print_pre()`, and domain helpers in `Helpers/dimensionamento.php`, `Helpers/produtos.php`, `Helpers/status.php`, `Helpers/config.php`.

### Database

MySQL via Laravel Sail. Migrations in `database/migrations/`. No Units tests for migrations — run `php artisan migrate:fresh --seed` to reset locally.

### Integrations

- **Aldo** (`app/src/Integracoes/Aldo/`) — scheduled ZIP download, XML parse, product upsert.
- **Edeltec** (`app/Http/Controllers/Admin/Integracoes/Edeltec/`) — daily artisan command `app:integracao-edeltec`.

## Docker / environment

`docker-compose.yml` (Laravel Sail) runs:
- `sail-8.3` app container on port 80
- MySQL 8.0 on port 3306 (data in `./sail-mysql/`)
- phpMyAdmin on port 81

Copy `.env.example` to `.env` and run `php artisan key:generate` before first use.
