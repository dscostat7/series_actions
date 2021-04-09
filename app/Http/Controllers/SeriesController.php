<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSeries;
use App\Temporada;
use App\Episodio;

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
            $request->qtd_episodios
        );
        $request->session()->flash('mensagem', "Série $serie->nome, 
        adicionada com sua(s) temporada(s) e seus episódio(s)!");
        
        return redirect()->route('index');
    }

    public function destroy (Request $request) {
        $serie = Serie::find($request->id);
        $nomeSerie = $serie->nome;
        $serie->temporadas->each(function (Temporada $temporada) {
            $temporada->episodios->each(function (Episodio $episodio) {
                $episodio->delete();
            });
            $temporada->delete();
        });
        $serie->delete();

        // Serie::destroy($request->id);
        $request->session()->flash('mensagem', "Série $nomeSerie removida com Sucesso");
        
        return redirect()->route('index');
    }
};
