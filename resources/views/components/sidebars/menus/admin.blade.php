
    <style>
        :root{
            --brand:#e25507; --brand-600:#cc4c06;
            --ink:#0f172a; --muted:#64748b; --line:#e5e7eb; --bg:#ffffff;
            --chip:#fff7f1; --chip-b:#ffd9c6;
        }

        /* ===== Wrapper do sidenav ===== */
        .sidenav{ padding:.5rem .25rem; }
        .sidenav .menu-title{
            font-size:.78rem; text-transform:uppercase; letter-spacing:.06em;
            color:var(--muted); font-weight:800; margin:.25rem .35rem .5rem;
        }

        /* ===== Botão do topo ===== */
        .sidenav .btn-admin{
            background:var(--bg); border:1px solid var(--line); color:var(--ink);
            font-weight:800; border-radius:12px; padding:.4rem .7rem;
            transition:transform .12s ease, border-color .12s ease, color .12s ease;
        }
        .sidenav .btn-admin:hover{ transform:translateY(-1px); border-color:var(--brand); color:var(--brand); }

        /* ===== Links nível 1 ===== */
        .sidenav .nav-item{ margin-bottom:.25rem; }
        .sidenav .nav-link{
            position:relative;
            display:flex; align-items:center; gap:.6rem;
            padding:.6rem .75rem;
            color:var(--ink); background:var(--bg);
            border:1px solid transparent; border-radius:14px;
            font-weight:600; letter-spacing:.1px;
            transition:transform .12s ease, border-color .12s ease, box-shadow .12s ease;
        }
        .sidenav .nav-link:hover{
            border-color:var(--line);
            transform:translateY(-1px);
        }
        .sidenav .nav-link .bi{
            font-size:1.1rem; width:22px; text-align:center; color:var(--muted);
            transition:color .12s ease;
        }
        .sidenav .nav-link:hover .bi{ color:var(--brand); }

        /* Caret (seta) */
        .sidenav .nav-caret{
            margin-left:auto; color:#9aa5b1; font-size:.9rem;
            transition:transform .18s ease, color .12s ease; opacity:.9;
        }
        .sidenav .nav-link[aria-expanded="true"] .nav-caret{ transform:rotate(90deg); color:var(--brand); }

        /* Ativo/aberto */
        .sidenav .nav-link.active,
        .sidenav .nav-link[aria-expanded="true"]{
            border-color:var(--chip-b);
            box-shadow:0 8px 20px rgba(226,85,7,.06);
        }
        .sidenav .nav-link.active::before,
        .sidenav .nav-link[aria-expanded="true"]::before{
            content:""; position:absolute; left:8px; top:10px; bottom:10px; width:3px; border-radius:3px;
            background:linear-gradient(180deg,var(--brand),var(--brand-600));
        }

        /* ===== Submenu ===== */
        .sidenav .collapse{
            padding-left:10px;
            border-left:2px dashed #eef2f6;  /* igual ao modelo enviado */
        }
        .sidenav .nav-sm .nav-item{ margin:.18rem 0; }
        .sidenav .nav-sm .nav-link{
            display:flex; align-items:center; gap:.45rem;
            padding:.45rem .6rem; border-radius:10px; font-weight:500;
            border:1px solid transparent; color:#1b2538;
        }
        .sidenav .nav-sm .nav-link .bi{ width:18px; font-size:1rem; color:#8a94a1; }
        .sidenav .nav-sm .nav-link:hover{ background:#fff; border-color:#eef2f6; }
        .sidenav .nav-sm .nav-link.active{ /* visual ativo simples como no modelo */ }
        .sidenav .nav-sm .nav-link.active .bi{ color:var(--brand); }

        /* Remove caret padrão do Bootstrap (se houver) */
        .sidenav .nav-link::after{ display:none !important; content:none !important; }
    </style>


<ul class="navbar-nav sidenav mb-md-5">
    {{-- Alternar para Vendedor (quando permitido) --}}
    @if ((new \App\src\Usuarios\TiposUsuarios())->isAdminVendedor())
        <form method="POST"
              action="{{ route('alterar-tipo-usuario', [id_usuario_atual(), (new \App\src\Usuarios\Vendedores())->getChave()]) }}">
            @csrf
            <div class="row mb-2">
                <button class="btn btn-admin btn-sm mx-auto">
                    <i class="bi bi-person-badge me-1"></i> Acessar como VENDEDOR
                </button>
            </div>
        </form>
    @endif

    {{-- Usuários --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='usuarios') active @endif"
           href="#navbar-usuarios" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='usuarios' ? 'true' : 'false' }}"
           aria-controls="navbar-usuarios">
            <i class="bi bi-people"></i>
            <span class="nav-link-text">Usuários</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='usuarios') show @endif" id="navbar-usuarios">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='usuarios' && SUBMENU==='vendedores') active @endif"
                       href="{{ route('admin.usuarios.vendedores.index') }}">
                        Vendedores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='usuarios' && SUBMENU==='admins') active @endif"
                       href="{{ route('admin.usuarios.admins.index') }}">
                        Administradores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='usuarios' && SUBMENU==='gerente-vendas') active @endif"
                       href="{{ route('admin.usuarios.admins-vendedores.index') }}">
                        Gerentes de Vendas
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Orçamentos --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='orcamentos') active @endif"
           href="#navbar-orcamentos" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='orcamentos' ? 'true' : 'false' }}"
           aria-controls="navbar-orcamentos">
            <i class="bi bi-folder"></i>
            <span class="nav-link-text">Orçamentos</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='orcamentos') show @endif" id="navbar-orcamentos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='orcamentos' && empty($_GET['status']) && SUBMENU==='todos_orcamentos') active @endif"
                       href="{{ route('admin.orcamentos.index') }}">
                        Geradores Fotovoltaicos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='orcamentos' && SUBMENU==='servicos') active @endif"
                       href="{{ route('admin.servicos.index') }}">
                        Serviços
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Contratos --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='contratos') active @endif"
           href="#navbar-contratos" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='contratos' ? 'true' : 'false' }}"
           aria-controls="navbar-contratos">
            <i class="bi bi-journal"></i>
            <span class="nav-link-text">Contratos</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='contratos') show @endif" id="navbar-contratos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='contratos' && empty($_GET['status']) && SUBMENU==='todos_contratos') active @endif"
                       href="#">
                        Todos Contratos
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Kits Fotovoltaicos --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='kits_fv') active @endif"
           href="#navbar-kits-fv" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='kits_fv' ? 'true' : 'false' }}"
           aria-controls="navbar-kits-fv">
            <i class="bi bi-box"></i>
            <span class="nav-link-text">Kits Fotovoltaicos</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='kits_fv') show @endif" id="navbar-kits-fv">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='kits_fv' && SUBMENU==='cadastrar_kit_fv') active @endif"
                       href="{{ route('admin.produtos.kits.create') }}">
                        Cadastrar Kit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='kits_fv' && SUBMENU==='kits_fv_cadastrados') active @endif"
                       href="{{ route('admin.produtos.kits.index') }}">
                        Kits Cadastrados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='kits_fv' && SUBMENU==='kits_fv_status') active @endif"
                       href="{{ route('admin.produtos.status-kits.index') }}">
                        Status dos Kits
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Dashboards --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='dashboards') active @endif"
           href="#navbar-dashboards" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='dashboards' ? 'true' : 'false' }}"
           aria-controls="navbar-dashboards">
            <i class="bi bi-graph-up-arrow"></i>
            <span class="nav-link-text">Dashboards</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='dashboards') show @endif" id="navbar-dashboards">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='dashboards' && SUBMENU==='dashboards-financeiro') active @endif"
                       href="{{ route('admin.dashboard.financeiro') }}">
                        Graficos Financeiro
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='dashboards' && SUBMENU==='dashboards-vendas') active @endif"
                       href="{{ route('admin.dashboard.vendas') }}">
                        Graficos de Vendas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='dashboards' && SUBMENU==='dashboards-gestao') active @endif"
                       href="{{ route('admin.dashboard.gestao') }}">
                        Graficos de Gestão
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Precificação --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='margens') active @endif"
           href="#navbar-margens" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='margens' ? 'true' : 'false' }}"
           aria-controls="navbar-margens">
            <i class="bi bi-coin"></i>
            <span class="nav-link-text">Precificação</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='margens') show @endif" id="navbar-margens">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='margens' && SUBMENU==='margem-principal') active @endif"
                       href="{{ route('admin.precificacao.margem-principal.index') }}">
                        Margens Principal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='margens' && SUBMENU==='margem-fornecedor') active @endif"
                       href="{{ route('admin.precificacao.fornecedor.index') }}">
                        Por Fornecedores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='margens' && SUBMENU==='margem-estado') active @endif"
                       href="{{ route('admin.precificacao.estado.index') }}">
                        Por Estados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='margens' && SUBMENU==='margem-vendedor') active @endif"
                       href="{{ route('admin.precificacao.vendedor.index') }}">
                        Por Vendedores
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Produtos --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='produtos') active @endif"
           href="#navbar-produtos" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='produtos' ? 'true' : 'false' }}"
           aria-controls="navbar-produtos">
            <i class="bi bi-box-seam"></i>
            <span class="nav-link-text">Produtos</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='produtos') show @endif" id="navbar-produtos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='produtos' && SUBMENU==='inversores') active @endif"
                       href="{{ route('admin.produtos.inversores.index') }}">
                        Inversores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='produtos' && SUBMENU==='paineis') active @endif"
                       href="{{ route('admin.produtos.paineis.index') }}">
                        Painéis
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='produtos' && SUBMENU==='trafos') active @endif"
                       href="{{ route('admin.produtos.trafos.index') }}">
                        Transformadores
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Fornecedores --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='fornecedores') active @endif"
           href="#navbar-fornecedores" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='fornecedores' ? 'true' : 'false' }}"
           aria-controls="navbar-fornecedores">
            <i class="bi bi-truck"></i>
            <span class="nav-link-text">Fornecedores</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='fornecedores') show @endif" id="navbar-fornecedores">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='fornecedores' && SUBMENU==='fornecedores_cadastrados') active @endif"
                       href="{{ route('admin.fornecedores.index') }}">
                        Cadastrados
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Integrações --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='integracoes') active @endif"
           href="#navbar-integracoes" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='integracoes' ? 'true' : 'false' }}"
           aria-controls="navbar-integracoes">
            <i class="bi bi-link"></i>
            <span class="nav-link-text">Integrações</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='integracoes') show @endif" id="navbar-integracoes">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='integracoes' && SUBMENU==='edeltec') active @endif"
                       href="{{ route('admin.integracoes.eldeltec.index') }}">
                        Edeltec Solar
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link @if(MENU==='integracoes' && SUBMENU==='arquivo') active @endif"--}}
{{--                       href="{{ route('admin.integracoes.arquivo.index') }}">--}}
{{--                        Planilha Excel--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link @if(MENU==='integracoes' && SUBMENU==='historico-integracoes') active @endif"--}}
{{--                       href="{{ route('admin.integracoes.historico.index') }}">--}}
{{--                        Histórico de Integrações--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </li>

    {{-- Financeiro --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='financeiro') active @endif"
           href="#navbar-financeiro" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='financeiro' ? 'true' : 'false' }}"
           aria-controls="navbar-financeiro">
            <i class="bi bi-bank"></i>
            <span class="nav-link-text">Financeiro</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='financeiro') show @endif" id="navbar-financeiro">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='financeiro' && SUBMENU==='comissao-venda') active @endif"
                       href="{{ route('admin.financeiro.comissao-venda.index') }}">
                        Taxa de Comissão por Venda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='financeiro' && SUBMENU==='bancos') active @endif"
                       href="{{ route('admin.configs.bancos.index') }}">
                        Bancos
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Configurações --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='configs') active @endif"
           href="#navbar-configs" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='configs' ? 'true' : 'false' }}"
           aria-controls="navbar-configs">
            <i class="bi bi-gear"></i>
            <span class="nav-link-text">Configurações</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='configs') show @endif" id="navbar-configs">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='configs' && SUBMENU==='dimensionamento') active @endif"
                       href="{{ route('admin.configs.dimensionamento.index') }}">
                        Dimensionamento
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='configs' && SUBMENU==='concessionarias') active @endif"
                       href="{{ route('admin.configs.concessionarias.index') }}">
                        Concessionarias
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='configs' && SUBMENU==='sistema') active @endif"
                       href="{{ route('admin.configs.sistema.index') }}">
                        Sistema
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Perfil --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU==='perfil') active @endif"
           href="#navbar-perfil" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU==='perfil' ? 'true' : 'false' }}"
           aria-controls="navbar-perfil">
            <i class="bi bi-person"></i>
            <span class="nav-link-text">Perfil</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU==='perfil') show @endif" id="navbar-perfil">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(MENU==='perfil' && SUBMENU==='senha') active @endif"
                       href="{{ route('admin.senha.edit', id_usuario_atual()) }}">
                        Trocar Senha
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>


    <script>
        (function(){
            const root = document.querySelector('.sidenav');
            if(!root) return;

            // fecha irmãos ao abrir
            root.addEventListener('show.bs.collapse', function(e){
                root.querySelectorAll('.collapse.show').forEach(el => { if(el !== e.target) $(el).collapse('hide'); });
            });

            // persistência simples (opcional)
            root.addEventListener('shown.bs.collapse', e => localStorage.setItem('sidenav_admin_open', '#' + e.target.id));
            root.addEventListener('hidden.bs.collapse', e => {
                const key = localStorage.getItem('sidenav_admin_open');
                if (key === '#' + e.target.id) localStorage.removeItem('sidenav_admin_open');
            });
            const openId = localStorage.getItem('sidenav_admin_open');
            if (openId) { const el = document.querySelector(openId); if(el) $(el).collapse('show'); }
        })();
    </script>

