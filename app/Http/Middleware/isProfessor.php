<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isProfessor
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
        $tipo = Auth::user()->tipo_user;

        if ($tipo == 'A') {
            return $next($request);
        } elseif ($tipo != 'P') {
            flash()->overlay('Você não tem permissão para acessar esta área do sistema! Contate o Administrador.', 'Atenção!');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
