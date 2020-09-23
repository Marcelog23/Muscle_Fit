<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->tipo_user != 'A') {
            flash()->overlay('Você não tem permissão para acessar esta área do sistema! Contate o Administrador.', 'Atenção!');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
