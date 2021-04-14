<?php

namespace App\Listeners;

use App\User;
use App\Events\NovaSerie;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        // $user = $request->user();
        $nomeSerie = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        $users = User::all();
        foreach ($users as $indice => $user) {

            $multiplicador = $indice + 1;
            $email = new \App\Mail\NovaSerie ($nomeSerie, $qtdTemporadas, $qtdEpisodios);
            $email->subject = 'Nova Série Adicionada';

            $quando = now()->addSecond($multiplicador * 5);
            \Illuminate\Support\Facades\Mail::to($user)->later($quando, $email);
            // sleep(5);
        } // Enviando email de Nova Série cadastrada para todos os usuários cadastrados no sistema.
    }
}
