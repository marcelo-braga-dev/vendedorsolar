
    <style>
        :root{
            --brand:#e25507; --brand-600:#cc4c06;
            --ink:#0f172a; --muted:#64748b; --line:#e5e7eb; --bg:#ffffff;
            --chip:#fff7f1; --chip-b:#ffd9c6;
        }

        /* ===== Wrapper do sidenav ===== */
        .sidenav{
            padding:.5rem .25rem;
        }
        .sidenav .menu-title{
            font-size:.78rem; text-transform:uppercase; letter-spacing:.06em;
            color:var(--muted); font-weight:800; margin:.25rem .35rem .5rem;
        }

        /* ===== Botão do topo (ADMIN) ===== */
        .sidenav .btn-admin{
            background:var(--bg); border:1px solid var(--line); color:var(--ink);
            font-weight:800; border-radius:12px; padding:.4rem .7rem;
            transition:transform .12s ease, border-color .12s ease, color .12s ease;
        }
        .sidenav .btn-admin:hover{ transform:translateY(-1px); border-color:var(--brand); color:var(--brand); }

        /* ===== Links nível 1 ===== */
        .sidenav .nav-item{ margin-bottom:.25rem; }
        .sidenav .nav-link{
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

        /* Caret (seta direita) */
        .sidenav .nav-caret{
            margin-left:auto; color:#9aa5b1; font-size:.9rem; transition:transform .18s ease, color .12s ease; opacity:.9;
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
        .sidenav .nav-link{ position:relative; }

        /* ===== Submenu ===== */
        .sidenav .collapse{
            /*margin:.35rem 0 .5rem .75rem;*/
            /*margin-left: 3px;*/
            padding-left:10px;
            /*padding:.3rem 0 .2rem .55rem;
            */
            border-left:2px dashed #eef2f6;
        }
        .sidenav .nav-sm .nav-item{ margin:.18rem 0; }
        .sidenav .nav-sm .nav-link{
            display:flex; align-items:center; gap:.45rem;
            padding:.45rem .6rem; border-radius:10px; font-weight:500;
            border:1px solid transparent; color:#1b2538;
        }
        .sidenav .nav-sm .nav-link .bi{ width:18px; font-size:1rem; color:#8a94a1; }
        .sidenav .nav-sm .nav-link:hover{ background:#fff; border-color:#eef2f6; }
        .sidenav .nav-sm .nav-link.active{
            /*background:var(--chip); border-color:var(--chip-b);*/
        }
        .sidenav .nav-sm .nav-link.active .bi{ color:var(--brand); }

        /* Remove caret padrão do Bootstrap (se houver) */
        .sidenav .nav-link::after{ display:none !important; content:none !important; }
    </style>


<ul class="navbar-nav sidenav mb-md-5">
    @if ((new \App\src\Usuarios\TiposUsuarios())->isAdminVendedor())
        <form method="POST"
              action="{{ route('alterar-tipo-usuario', [id_usuario_atual(), (new \App\src\Usuarios\Admin())->getChave()]) }}">
            @csrf
            <div class="row mb-2">
                <button class="btn btn-admin btn-sm mx-auto">
                    <i class="bi bi-shield-check me-1"></i> Acessar como ADMIN
                </button>
            </div>
        </form>
    @endif

    {{-- Clientes --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU == 'clientes') active @endif"
           href="#navbar-clientes" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU=='clientes' ? 'true' : 'false' }}"
           aria-controls="navbar-clientes">
            <i class="bi bi-people"></i>
            <span class="nav-link-text">Clientes</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU == 'clientes') show @endif" id="navbar-clientes">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'cadastrar') active @endif"
                       href="{{ route('vendedor.clientes.create') }}">
                        <i class="bi bi-person-plus"></i> Cadastrar Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'cadastrados') active @endif"
                       href="{{ route('vendedor.clientes.index') }}">
                        <i class="bi bi-card-list"></i> Clientes Cadastrados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'leads') active @endif"
                       href="{{ route('vendedor.leads.index') }}">
                        <i class="bi bi-funnel"></i> Leads
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Gerar Propostas --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU == 'dimensionamento') active @endif"
           href="#navbar-dimensionamento" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU=='dimensionamento' ? 'true' : 'false' }}"
           aria-controls="navbar-dimensionamento">
            <i class="bi bi-file-earmark-arrow-up"></i>
            <span class="nav-link-text">Gerar Propostas</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU == 'dimensionamento') show @endif" id="navbar-dimensionamento">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'convencional') active @endif"
                       href="{{ route('vendedor.dimensionamento.convencional.index') }}">
                        <i class="bi bi-lightning-charge"></i> Sistema Convencional
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'demanda') active @endif"
                       href="{{ route('vendedor.dimensionamento.demanda.index') }}">
                        <i class="bi bi-graph-up-arrow"></i> Sistema com Demanda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'servicos') active @endif"
                       href="{{ route('vendedor.servicos.create') }}">
                        <i class="bi bi-briefcase"></i> Serviços
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Orçamentos --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU == 'orcamentos') active @endif"
           href="#navbar-orcamentos" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU=='orcamentos' ? 'true' : 'false' }}"
           aria-controls="navbar-orcamentos">
            <i class="bi bi-folder"></i>
            <span class="nav-link-text">Orçamentos</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU == 'orcamentos') show @endif" id="navbar-orcamentos">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(empty($_GET['status']) && SUBMENU == 'todos_orcamentos') active @endif"
                       href="{{ route('vendedor.orcamento.index') }}">
                        <i class="bi bi-sun"></i> Geradores Fotovoltaicos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(empty($_GET['status']) && SUBMENU == 'servicos') active @endif"
                       href="{{ route('vendedor.servicos.index') }}">
                        <i class="bi bi-briefcase"></i> Serviços
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Visita Técnica --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU == 'visita') active @endif"
           href="#navbar-visita" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU=='visita' ? 'true' : 'false' }}"
           aria-controls="navbar-visita">
            <i class="bi bi-house"></i>
            <span class="nav-link-text">Visita Técnica</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU == 'visita') show @endif" id="navbar-visita">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'agendadas') active @endif"
                       href="{{ route('vendedor.visitas.index') }}">
                        <i class="bi bi-calendar-check"></i> Agendadas
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Contratos --}}
    @if (implementadoContratos())
        <li class="nav-item">
            <a class="nav-link @if(MENU == 'contratos') active @endif"
               href="#navbar-contratos" data-toggle="collapse" role="button"
               aria-expanded="{{ MENU=='contratos' ? 'true' : 'false' }}"
               aria-controls="navbar-contratos">
                <i class="bi bi-archive"></i>
                <span class="nav-link-text">Contratos</span>
                <i class="bi bi-caret-right-fill nav-caret"></i>
            </a>
            <div class="collapse @if(MENU == 'contratos') show @endif" id="navbar-contratos">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link @if(SUBMENU == 'contratos-gerados') active @endif"
                           href="{{ route('vendedor.contratos.index') }}">
                            <i class="bi bi-journal-text"></i> Contratos Gerados
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endif

    {{-- Mensagens --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU == 'mensagens') active @endif"
           href="#navbar-mensagens" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU=='mensagens' ? 'true' : 'false' }}"
           aria-controls="navbar-mensagens">
            <i class="bi bi-chat"></i>
            <span class="nav-link-text">Mensagens</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU == 'mensagens') show @endif" id="navbar-mensagens">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'avisos') active @endif"
                       href="{{ route('vendedor.alertas.index') }}">
                        <i class="bi bi-megaphone"></i> Avisos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'conversas') active @endif"
                       href="{{ route('vendedor.mensagens.index') }}">
                        <i class="bi bi-chat-dots"></i> Conversas
                    </a>
                </li>
            </ul>
        </div>
    </li>

    {{-- Perfil --}}
    <li class="nav-item">
        <a class="nav-link @if(MENU == 'perfil') active @endif"
           href="#navbar-perfil" data-toggle="collapse" role="button"
           aria-expanded="{{ MENU=='perfil' ? 'true' : 'false' }}"
           aria-controls="navbar-perfil">
            <i class="bi bi-person"></i>
            <span class="nav-link-text">Sua Conta</span>
            <i class="bi bi-caret-right-fill nav-caret"></i>
        </a>
        <div class="collapse @if(MENU == 'perfil') show @endif" id="navbar-perfil">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'dados') active @endif"
                       href="{{ route('vendedor.perfil.edit', id_usuario_atual()) }}">
                        <i class="bi bi-person-lines-fill"></i> Seus Dados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(SUBMENU == 'senha') active @endif"
                       href="{{ route('vendedor.senha.edit', id_usuario_atual()) }}">
                        <i class="bi bi-shield-lock"></i> Alterar Senha
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

            // Fecha seções irmãs ao abrir uma
            root.addEventListener('show.bs.collapse', function(e){
                const opened = root.querySelectorAll('.collapse.show');
                opened.forEach(el => { if(el !== e.target) $(el).collapse('hide'); });
            });

            // Persistência simples (opcional): salva última seção aberta
            root.addEventListener('shown.bs.collapse', e => localStorage.setItem('sidenav_open', '#' + e.target.id));
            root.addEventListener('hidden.bs.collapse', e => {
                const key = localStorage.getItem('sidenav_open');
                if (key === '#' + e.target.id) localStorage.removeItem('sidenav_open');
            });
            const openId = localStorage.getItem('sidenav_open');
            if (openId) { const el = document.querySelector(openId); if(el) $(el).collapse('show'); }
        })();
    </script>

