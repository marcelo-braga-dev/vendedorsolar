<ul class="navbar-nav mb-md-5">
    @if ((new \App\src\Usuarios\TiposUsuarios())->isAdminVendedor())
        <form method="POST"
              action="{{ route('alterar-tipo-usuario', [id_usuario_atual(),
            (new \App\src\Usuarios\Admin())->getChave()]) }}">@csrf
            <div class="row mb-2">
                <button class="btn btn-primary btn-sm mx-auto">Acessar como ADMIN</button>
            </div>
        </form>
    @endif
    {{-- Clientes --}}
    <li class="nav-item">
        <a class="nav-link text-dark" href="#navbar-clientes" data-toggle="collapse" role="button"
           aria-expanded="true"
           aria-controls="navbar-clientes">
{{--            <i class="fas fa-users" style="font-size: 18px"></i>--}}
            <i class="bi bi-people" style="font-size: 20px"></i>
            <span class="nav-link-text">
                Clientes
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU == 'clientes') show @endif" id="navbar-clientes">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'cadastrar') active @endif"
                       href="{{ route('vendedor.clientes.create') }}">
                        Cadastrar Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'cadastrados') active @endif"
                       href="{{ route('vendedor.clientes.index') }}">
                        Clientes Cadastrados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'leads') active @endif"
                       href="{{ route('vendedor.leads.index') }}">
                        Leads
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Dimensionamento --}}
    <li class="nav-item">
        <a class="nav-link text-dark" href="#navbar-dimensionamento" data-toggle="collapse" role="button"
           aria-expanded="true"
           aria-controls="navbar-dimensionamento">
            <i class="bi bi-file-earmark-arrow-up" style="font-size: 20px"></i>
            <span class="nav-link-text">
                Gerar Propostas
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU == 'dimensionamento') show @endif" id="navbar-dimensionamento">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'convencional') active @endif"
                       href="{{ route('vendedor.dimensionamento.convencional.index') }}">
                        Sistema Convencional
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'demanda') active @endif"
                       href="{{ route('vendedor.dimensionamento.demanda.index') }}">
                        Sistema com Demanda
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Orcamentos --}}
    <li class="nav-item">
        <a class="nav-link text-dark" href="#navbar-orcamentos" data-toggle="collapse" role="button"
           aria-expanded="true"
           aria-controls="navbar-orcamentos">
            <i class="bi bi-folder" style="font-size: 20px"></i>
            <span class="nav-link-text">
                Orçamentos
            </span>
        </a>

        <div class="collapse ml-4 @if(MENU == 'orcamentos') show @endif" id="navbar-orcamentos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(empty($_GET['status']) && SUBMENU == 'todos_orcamentos') active @endif"
                       href="{{ route('vendedor.orcamento.index') }}">
                        Todos Orçamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'novos') active @endif"
                       href="{{ route('vendedor.orcamento.index', ['status' => 'novos']) }}">
                        Novos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'assinados') active @endif"
                       href="{{ route('vendedor.orcamento.index', ['status' => 'assinados']) }}">
                        Em Aprovação
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'aprovados') active @endif"
                       href="{{ route('vendedor.orcamento.index', ['status' => 'aprovados']) }}">
                        Aprovados
                    </a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'instalandos') active @endif"--}}
                {{--                       href="{{ route('vendedor.orcamento.index', ['status' => 'instalandos']) }}">--}}
                {{--                        Em Instalação--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link @if(!empty($_GET['status']) && $_GET['status'] == 'finalizados') active @endif"--}}
                {{--                       href="{{ route('vendedor.orcamento.index', ['status' => 'finalizados']) }}">--}}
                {{--                        Finalizados--}}
                {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </li>
    {{-- Visita --}}
    <li class="nav-item">
        <a class="nav-link text-dark" href="#navbar-visita" data-toggle="collapse" role="button"
           aria-expanded="true"
           aria-controls="navbar-visita">
            <i class="bi bi-house" style="font-size: 20px"></i>
            <span class="nav-link-text">
                Visita Técnica
            </span>
        </a>
        <div class="collapse ml-4 @if(MENU == 'visita') show @endif" id="navbar-visita">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'agendadas') active @endif"
                       href="{{ route('vendedor.visitas.index') }}">
                        Agendadas
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{-- Contratos --}}
    @if (implementadoContratos())
        <li class="nav-item">
            <a class="nav-link text-dark" href="#navbar-contratos" data-toggle="collapse" role="button"
               aria-expanded="true"
               aria-controls="navbar-contratos">
                <i class="bi bi-archive" style="font-size: 18px"></i>
                <span class="nav-link-text">
                Contratos
            </span>
            </a>
            <div class="collapse ml-4 @if(MENU == 'contratos') show @endif" id="navbar-contratos">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link @if(SUBMENU == 'contratos-gerados') active @endif"
                           href="{{ route('vendedor.contratos.index') }}">
                            Contratos Gerados
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif

    {{-- Financeiro --}}
    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link text-dark" href="#navbar-financeiro" data-toggle="collapse" role="button"--}}
    {{--           aria-expanded="true"--}}
    {{--           aria-controls="navbar-financeiro">--}}
    {{--            <i class="fas fa-dollar-sign"></i>--}}
    {{--            <span class="nav-link-text">--}}
    {{--                Financeiro--}}
    {{--            </span>--}}
    {{--        </a>--}}
    {{--        <div class="collapse ml-4 @if(MENU == 'financeiro') show @endif" id="navbar-financeiro">--}}
    {{--            <ul class="nav nav-sm flex-column">--}}
    {{--                <li class="nav-item">--}}
    {{--                    <a class="nav-link @if(SUBMENU == 'faturamento') active @endif"--}}
    {{--                       href="{{ route('vendedor.financeiro.faturamento.index') }}">--}}
    {{--                        Faturamento--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    </li>--}}

    {{-- Mensagens --}}
    <li class="nav-item">
        <a class="nav-link text-dark" href="#navbar-mensagens" data-toggle="collapse" role="button"
           aria-expanded="true"
           aria-controls="navbar-mensagens">
            <i class="bi bi-chat" style="font-size: 20px"></i>
            <span class="nav-link-text">Mensagens</span>
        </a>
        <div class="collapse ml-4 @if(MENU == 'mensagens') show @endif" id="navbar-mensagens">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'avisos') active @endif"
                       href="{{ route('vendedor.alertas.index') }}">
                        Avisos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'conversas') active @endif"
                       href="{{ route('vendedor.mensagens.index') }}">
                        Conversas
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Perfil --}}
    <li class="nav-item">
        <a class="nav-link text-dark" href="#navbar-perfil" data-toggle="collapse" role="button"
           aria-expanded="true"
           aria-controls="navbar-perfil">
            <i class="bi bi-person" style="font-size: 22px"></i>
            <span class="nav-link-text">
                Sua Conta
            </span>
        </a>
        <div class="collapse ml-4 @if(MENU == 'perfil') show @endif" id="navbar-perfil">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'dados') active @endif"
                       href="{{ route('vendedor.perfil.edit', id_usuario_atual()) }}">
                        Seus Dados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'senha') active @endif"
                       href="{{ route('vendedor.senha.edit', id_usuario_atual()) }}">
                        Alterar Senha
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>


