<h6 class="navbar-heading text-muted">Admin</h6>
<ul class="navbar-nav mb-md-5">
    {{--Usuaios --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-dimensionamento" data-toggle="collapse"
           role="button" aria-expanded="true"
           aria-controls="navbar-dimensionamento">
            <i class="fas fa-user"></i>
            <span class="nav-link-text">
                Usuários
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'usuarios') show @endif" id="navbar-dimensionamento">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU.SUBMENU === 'usuarios'.'vendedores') active @endif"
                       href="{{ route('admin.usuarios.vendedores.index') }}">
                        Vendedores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU.SUBMENU === 'usuarios'.'admins') active @endif"
                       href="{{ route('admin.usuarios.admins.index') }}">
                        Administradores
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{--LEADS Site
    <li class="nav-item">
        <a class="nav-link text-primary" href="#navbar-leads" data-toggle="collapse"
           role="button" aria-expanded="true"
           aria-controls="navbar-leads">
            <i class="fas fa-globe"></i>
            <span class="nav-link-text">
                Leads Site
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'leads') show @endif" id="navbar-leads">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU.SUBMENU === 'leads'.'novos') active @endif"
                       href="{{ route('admin.leads.index') }}">
                        Novos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU.SUBMENU === 'leads'.'qualificados') active @endif"
                       href="{{ route('admin.leads.index', 'qualificado') }}">
                        Qualificados
                    </a>
                </li>
            </ul>
        </div>
    </li> --}}

    {{-- Orcamentos --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-orcamentos" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-orcamentos">
            <i class="fas fa-folder-open"></i>
            <span class="nav-link-text">
                Orçamentos
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'orcamentos') show @endif" id="navbar-orcamentos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(empty($_GET['status']) && SUBMENU === 'todos_orcamentos') active @endif"
                       href="{{ route('admin.orcamentos.index') }}">
                        Todos Orçamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'novos') active @endif"
                       href="{{ route('admin.orcamentos.index', ['status' => 'novos']) }}">
                        Novos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'assinados') active @endif"
                       href="{{ route('admin.orcamentos.index', ['status' => 'assinados']) }}">
                        Para Aprovação
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'aprovados') active @endif"
                       href="{{ route('admin.orcamentos.index', ['status' => 'aprovados']) }}">
                        Aprovados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'instalandos') active @endif"
                       href="{{ route('admin.orcamentos.index', ['status' => 'instalandos']) }}">
                        Em Instalação
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'finalizados') active @endif"
                       href="{{ route('admin.orcamentos.index', ['status' => 'finalizados']) }}">
                        Finalizados
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- kits Fotovoltaicos --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-kits-fv" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-kits-fv">
            <i class="fas fa-solar-panel"></i>
            <span class="nav-link-text">
                Kits Fotovoltaios
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'kits_fv') show @endif" id="navbar-kits-fv">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'cadastrar_kit_fv') active @endif"
                       href="{{ route('admin.produtos.kits.create') }}">
                        Cadastrar Kit
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'kits_fv_cadastrados') active @endif"
                       href="{{ route('admin.produtos.kits.index') }}">
                        Kits Cadastrados
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'kits_fv_status') active @endif"
                       href="{{ route('admin.produtos.status-kits.index') }}">
                        Status dos Kits
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Precificacao --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-margens" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-margens ">
            <i class="fas fa-dollar-sign"></i>
            <span class="nav-link-text">
                Precificação
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'margens') show @endif" id="navbar-margens">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'margem-principal') active @endif"
                       href="{{ route('admin.precificacao.margem-principal.index') }}">
                        Margens Principal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'margem-vendedor') active @endif"
                       href="{{ route('admin.precificacao.vendedor.index') }}">
                        Por Vendedor
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'margem-estrutura') active @endif"
                       href="{{ route('admin.precificacao.estrutura.index') }}">
                        Por Estrutura
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Produtos --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-produtos" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-produtos">
            <i class="fas fa-dolly-flatbed"></i>
            <span class="nav-link-text">
                Produtos
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'produtos') show @endif" id="navbar-produtos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'inversores') active @endif"
                       href="{{ route('admin.produtos.inversores.index') }}">
                        Inversores
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'paineis') active @endif"
                       href="{{ route('admin.produtos.paineis.index') }}">
                        Painéis
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'trafos') active @endif"
                       href="{{ route('admin.produtos.trafos.index') }}">
                        Transformadores
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Fornecedores --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-fornecedores" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-fornecedores">
            <i class="fas fa-truck"></i>
            <span class="nav-link-text">
                Fornecedores
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'fornecedores') show @endif" id="navbar-fornecedores">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'fornecedores_cadastrados') active @endif"
                       href="{{ route('admin.fornecedores.index') }}">
                        Cadastrados
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Integracoes --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-integracoes" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-integracoes ">
            <i class="fas fa-link"></i>
            <span class="nav-link-text">
                Integracões
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'integracoes') show @endif" id="navbar-integracoes">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'aldo') active @endif"
                       href="{{ route('admin.integracoes.aldo.index') }}">
                        Aldo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'historico-integracoes') active @endif"
                       href="{{ route('admin.integracoes.historico.index') }}">
                        Histórico de Integrações
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Financeiro --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-financeiro" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-financeiro ">
            <i class="fas fa-dollar-sign"></i>
            <span class="nav-link-text">
                Financeiro
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'financeiro') show @endif" id="navbar-financeiro">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'comissao-venda') active @endif"
                       href="{{ route('admin.financeiro.comissao-venda.index') }}">
                        Taxa de Comissão por Venda
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link @if(SUBMENU === 'faturamento') active @endif"--}}
{{--                       href="{{ route('admin.financeiro.faturamento.index') }}">--}}
{{--                        Faturamento por Vendedor--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'bancos') active @endif"
                       href="{{ route('admin.configs.bancos.index') }}">
                        Bancos
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Config --}}
    <li class="nav-item border-bottom">
        <a class="nav-link text-primary" href="#navbar-config" data-toggle="collapse" role="button"
           aria-expanded="true" aria-controls="navbar-config">
            <i class="fas fa-cogs"></i>
            <span class="nav-link-text">
                Configurações
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU === 'configs') show @endif" id="navbar-config">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'dimensionamento') active @endif"
                       href="{{ route('admin.configs.dimensionamento.index') }}">
                        Dimensionamento
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU === 'concessionarias') active @endif"
                       href="{{ route('admin.configs.concessionarias.index') }}">
                        Concessionarias
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link @if(SUBMENU === 'backup') active @endif"--}}
{{--                       href="{{ route('admin.configs.backup.index') }}">--}}
{{--                        Backup--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </li>
</ul>


