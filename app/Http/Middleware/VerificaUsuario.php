<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VerificaUsuario
{
    /**
     * HANDLE
     * Verifica si el usuario tiene una sesión activa.
     * Si no ha iniciado sesión, se redirige al login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario tiene una sesión activa
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder al sistema.');
        }

        // Final del middleware
        return $next($request);
    }
}