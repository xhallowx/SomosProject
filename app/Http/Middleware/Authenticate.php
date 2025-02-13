<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Maneja la petición entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard()->guest()) {
            // Redirige al login con un mensaje si el usuario no está autenticado.
            session()->flash('message', 'Debes iniciar sesión para acceder.');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
