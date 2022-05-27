<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
{{--    <a href="" class="dropdown-item">--}}
{{--        <i class="ni ni-single-02"></i>--}}
{{--        <span>MOBILE</span>--}}
{{--    </a>--}}

    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
        <i class="ni ni-user-run"></i>
        <span>Sair</span>
    </a>
</div>
