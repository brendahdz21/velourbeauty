<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaLoginCorreo;

use Illuminate\Support\Facades\Cache;

class EnviarCorreo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Se obtiene la información del usuario con sesión
        $user = $event->user;

        // Se crea una llave con el ID del usuario
        $key = 'login_' . $user->id;

        // Si registra un envío de correo, no se envía de nuevo
        if(Cache::has($key)){
            return;
        }

        // Si el correo se ha enviado, la info se guarda en
        // la cache por 10 segundos para evitar enviar otro
        Cache::put($key, true, now()->addSeconds(10));

        Mail::to($user->email)->send(new AlertaLoginCorreo($user));
    }
}