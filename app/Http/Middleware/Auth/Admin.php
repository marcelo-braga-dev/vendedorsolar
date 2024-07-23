<?php

namespace App\Http\Middleware\Auth;

use App\src\Usuarios\TiposUsuarios;
use App\src\Usuarios\Vendedores;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ((new \App\src\Usuarios\Admin())->auth()) {
            modalErro('Acesso negado!');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
