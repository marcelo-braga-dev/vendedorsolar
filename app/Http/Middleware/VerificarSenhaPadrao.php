<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class VerificarSenhaPadrao
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $senha = auth()->user()->password;
            if (Route::getCurrentRoute()->getName() == 'home') {
                if (password_verify('1234', $senha) && auth()->user()->tipo == 'vendedor') {
                    modalErro('Por favor, altere sua senha de acesso para uma diferente.');
                    return redirect()->route('vendedor.senha.edit', id_usuario_atual());
                }
            }
        }

        return $next($request);
    }
}
