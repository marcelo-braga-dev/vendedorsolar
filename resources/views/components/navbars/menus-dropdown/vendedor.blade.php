<li class="nav-item dropdown">
    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle bg-white">
                <i class="fas fa-cog text-dark text-lg"></i>
            </span>
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
        <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Olá, {{ auth()->user()->name }}</h6>
        </div>
        {{--        <a href="" class="dropdown-item">--}}
        {{--            <i class="ni ni-single-02"></i>--}}
        {{--            <span>{{ __('My profile') }}</span>--}}
        {{--        </a>--}}
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i class="ni ni-user-run"></i>
            <span>Sair</span>
        </a>
    </div>
</li>
