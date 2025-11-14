@extends('layouts.app', ['class' => 'bg-warning'])

@section('content')
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
                                </span>
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
                                       type="checkbox"
                                    {{ old('remember') ? 'checked' : '' }}>
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
                <div style="text-align: center; margin-top: 30px ">
                    <a href="https://play.google.com/store/apps/details?id=br.com.solmarengenharia&hl=pt_BR">
                        <img style="width: 200px" src="/assets/img/logos/download_android.png">
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
