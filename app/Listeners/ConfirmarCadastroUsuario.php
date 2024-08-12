<?php

namespace App\Listeners;

use App\Events\UsuarioCriado;
use App\Mail\UsuarioConfirmacao;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ConfirmarCadastroUsuario implements ShouldQueue
{
    public function __construct()
    {
        //
    }
    public function handle(UsuarioCriado $event): void
    {
        Mail::to($event->user->email)->send(new UsuarioConfirmacao($event->user));
    }
}
