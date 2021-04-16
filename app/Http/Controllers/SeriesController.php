<?php

namespace App\Http\Controllers;

use App\Events\NovaSerie;
use App\{Serie, Temporada, Episodio, User};
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Services\{CriadorDeSeries, RemovedorDeSerie};
use Illuminate\Http\Support\Facades\Auth;


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

        
        $capa = null;
        // $capa = $request->file('capa')->store('capas');
        if ($request->hasFile('capa')) {
            $capa = $request->file('capa')->store('capas');
        } 
        
        
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios,
            // $request->id,
            $capa
        );

        $eventoNovaSerie = new NovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios,
        );

        event($eventoNovaSerie);

        

        

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
