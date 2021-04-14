<?php

namespace App\Http\Controllers;

use App\Mail\NovaSerie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\{Serie, Temporada, Episodio, User};
use App\Services\{CriadorDeSeries, RemovedorDeSerie};


class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view ('index', compact('series', 'mensagem'));
    }

    public function create (Request $request) {
        return view ('adicionar');

    }
    
    public function store (SeriesFormRequest $request, CriadorDeSeries $criadorDeSerie) {

        
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios,
            $request->id
        );


        // $user = $request->user();

        $users = User::all();
        foreach ($users as $indice => $user) {

            $multiplicador = $indice + 1;
            $email = new \App\Mail\NovaSerie ($request->nome, $request->qtd_temporadas, $request->qtd_episodios);
            $email->subject = 'Nova Série Adicionada';

            $quando = now()->addSecond($multiplicador * 5);
            \Illuminate\Support\Facades\Mail::to($user)->later($quando, $email);
            // sleep(5);
        } // Enviando email de Nova Série cadastrada para todos os usuários cadastrados no sistema.

        

        $request->session()->flash('mensagem', "Série $serie->nome, 
        adicionada com sua(s) temporada(s) e seus episódio(s)!");
        
        return redirect()->route('index');
    }

    public function destroy (Request $request, RemovedorDeSerie $removedorDeSerie) {
        
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        
        $request->session()->flash('mensagem', "Série $nomeSerie removida com Sucesso");
        
        return redirect()->route('index');
    }

    public function editaNome (int $id, Request $request) {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
};
