<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * HANDLE
     * Permite el acceso únicamente a usuarios administradores.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar que haya sesión activa
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para continuar.');
        }

        // Verificar que el usuario sea administrador
        if (!Auth::user()->is_admin) {
            return redirect()->route('home')
                ->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        // Permitir acceso
        return $next($request);
    }
}