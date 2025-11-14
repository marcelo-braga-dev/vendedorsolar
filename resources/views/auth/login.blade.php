@extends('layouts.app', ['class' => 'bg-warning'])

@section('content')
    <style>
        :root {
            --solmar: #e25507;
            --solmar-dark: #b14205;
        }

        .ios-download-trigger {
            display: inline-flex;
            text-decoration: none;
        }

        .ios-download-img {
            max-width: 50px;
            height: auto;
            border-radius: 999px;
            box-shadow: 0 10px 25px rgba(226, 85, 7, 0.35);
            transition: transform .2s ease, filter .2s ease;
        }

        .ios-download-trigger:hover .ios-download-img {
            transform: translateY(-2px) scale(1.03);
            filter: brightness(1.05);

        }

        /* NOVO: container dos botões Android + iPhone */
        .store-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            margin-top: 30px;
            flex-wrap: wrap;
            text-align: center;
        }

        .store-btn-img {
            width: 200px;
            height: auto;
            display: block;
        }

        /* Modal Base */
        .ios-modal {
            position: fixed;
            inset: 0;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .ios-modal.is-open {
            display: flex;
        }

        .ios-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
        }

        .ios-modal-card {
            position: relative;
            width: 90%;
            max-width: 460px;
            background: #ffffff;
            padding: 26px 22px 20px;
            border-radius: 24px;
            z-index: 2;
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
            animation: modalIn .2s ease-out;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: translateY(12px) scale(.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .ios-modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            background: rgba(226,85,7,.1);
            font-size: 20px;
            cursor: pointer;
            transition: .2s;
            color: var(--solmar);
        }

        .ios-modal-close:hover {
            background: rgba(226,85,7,.2);
        }

        /* Header */
        .ios-modal-header {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 16px;
        }

        .ios-modal-icon {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--solmar), var(--solmar-dark));
            color: #fff;
            font-size: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(226,85,7,0.55);
        }

        .ios-modal-header h2 {
            margin: 0;
            font-size: 1.25rem;
            color: #222;
            font-weight: 600;
        }

        .ios-modal-subtitle {
            margin: 3px 0 0;
            font-size: .88rem;
            color: #666;
        }

        /* Steps */
        .ios-modal-steps {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 20px;
        }

        .ios-step {
            display: flex;
            gap: 12px;
            padding: 10px 14px;
            background: rgba(226,85,7,.05);
            border-radius: 14px;
            align-items: flex-start;
        }

        .ios-step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--solmar), var(--solmar-dark));
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: .9rem;
            box-shadow: 0 6px 12px rgba(226,85,7,.5);
        }

        .ios-step-content h3 {
            margin: 0 0 2px;
            font-size: 1rem;
            font-weight: 600;
            color: #222;
        }

        .ios-step-content p {
            margin: 0;
            font-size: .85rem;
            color: #555;
        }

        .ios-chip {
            background: rgba(226,85,7,.15);
            padding: 2px 8px;
            border-radius: 999px;
            font-size: .75rem;
            color: var(--solmar-dark);
        }

        /* Footer */
        .ios-modal-footer {
            border-top: 1px solid rgba(0,0,0,.08);
            padding-top: 14px;
        }

        .ios-modal-footer p {
            margin: 0 0 14px;
            font-size: .82rem;
            color: #777;
        }

        .ios-modal-ok {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            font-size: .92rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--solmar), var(--solmar-dark));
            color: #fff;
            box-shadow: 0 10px 20px rgba(226,85,7,.5);
            cursor: pointer;
            transition: .2s;
        }

        .ios-modal-ok:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }
    </style>


    <div class="container mt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="row">
                            <img class="px-5 d-block mx-auto" src="{{ getLogoPrincipal() }}" alt="logo"
                                 style="max-height: 100px">
                        </div>
                        <div class="text-center text-muted mb-4">
                            @if (env('APP_ENV') == 'local')
                                <b>Admin:</b> admin@teste.com<br>
                                <b>Vendedor:</b> vendedor@teste.com
                            @endif
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Email') }}" type="email" name="email"
                                           value="{{ old('email') }}" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" placeholder="Senha" type="password"
                                           value="@if (env('APP_ENV') == 'local'){{ '1234' }}@endif" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin"
                                       type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">Lembrar-me</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark my-4">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Botões Android + iPhone lado a lado --}}
                <div class="store-buttons">
                    <a class="link-playstore"
                       href="https://play.google.com/store/apps/details?id=br.com.solmarengenharia&hl=pt_BR">
                        <img alt="Download Android"
                             src="/assets/img/logos/download_android.png"
                             class="store-btn-img">
                    </a>

                    <a href="#" id="btn-ios-install" class="ios-download-trigger">
                        <img src="/assets/img/logos/download_iphone.png"
                             alt="Instalar no iPhone"
                             class="store-btn-img ios-download-img">
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="ios-install-modal" class="ios-modal" aria-hidden="true">
        <div class="ios-modal-backdrop"></div>

        <div class="ios-modal-card" role="dialog" aria-modal="true" aria-labelledby="ios-modal-title">
            <button type="button" class="ios-modal-close" id="ios-modal-close" aria-label="Fechar">&times;</button>

            <div class="ios-modal-header">
                <div>
                    <h2 id="ios-modal-title">Instale como App no seu iPhone</h2>
                </div>
            </div>

            <div class="ios-modal-steps">
                <div class="ios-step">
                    <div class="ios-step-number">1</div>
                    <div class="ios-step-content">
                        <h3>Clique em Compartilhar</h3>
                        <p>
                            Clique no botão
                            <span class="ios-chip">
                                Compartilhar
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="20" height="20" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3v12"></path>
                                    <path d="M16 7l-4-4-4 4"></path>
                                    <path d="M5 13v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6"></path>
                                </svg>
                            </span>
                            (ícone de quadrado com seta para cima).
                        </p>
                    </div>
                </div>

                <div class="ios-step">
                    <div class="ios-step-number">2</div>
                    <div class="ios-step-content">
                        <h3>Adicionar à Tela de Início</h3>
                        <p>Nas opções, toque em <strong>“Adicionar à Tela de Início”</strong>.</p>
                    </div>
                </div>

                <div class="ios-step">
                    <div class="ios-step-number">3</div>
                    <div class="ios-step-content">
                        <h3>Clique em Adicionar</h3>
                        <p>Confirme o nome e clique em <strong>Adicionar</strong>.</p>
                    </div>
                </div>
            </div>

            <div class="ios-modal-footer">
                <p>✨ Após isso, um ícone será criado na sua tela inicial.</p>
                <button type="button" class="ios-modal-ok" id="ios-modal-ok">
                    Entendi!
                </button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('ios-install-modal');
            const openBtn = document.getElementById('btn-ios-install');
            const closeBtn = document.getElementById('ios-modal-close');
            const okBtn = document.getElementById('ios-modal-ok');
            const backdrop = modal ? modal.querySelector('.ios-modal-backdrop') : null;

            if (!modal || !openBtn) return;

            function openModal(event) {
                if (event) event.preventDefault();
                modal.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('is-open');
                document.body.style.overflow = '';
            }

            openBtn.addEventListener('click', openModal);

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (okBtn) okBtn.addEventListener('click', closeModal);
            if (backdrop) backdrop.addEventListener('click', closeModal);

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                    closeModal();
                }
            });
        })();
    </script>

@endsection
