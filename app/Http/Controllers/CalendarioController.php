<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Calendario;
use App\Models\Anime;
use function copy;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    public function index($ano,$estacao){

        $calendarios = Calendario::join('animes', 'anime_calendario.nome_anime', '=', 'animes.nome')
                        ->select('anime_calendario.*', 'animes.image', 'animes.sinopse', 'animes.dia_da_semana','animes.link')
                        ->where('ano', $ano)
                        ->where('estacao', $estacao)
                        ->get();

        // agrupar os itens pelo dia da semana
        $agrupados = [];
        foreach ($calendarios as $calendario) {
            $agrupados[$calendario->dia_da_semana][] = $calendario;
        }

        if($agrupados != NULL){

            return view('calendarios.index', ['calendarios'=>$agrupados,'ano'=>$ano,'estacao'=>$estacao]);
        }else{

            return redirect('/');

        }

    }

    public function calendario(){

        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $calendarios = Calendario::select('anime_calendario.ano','anime_calendario.estacao')
                        ->distinct('anime_calendario.ano')
                        ->orderByDesc('anime_calendario.ano')
                        ->get();

        $anosEstacoes = [];

        foreach($calendarios as $calendario){
            $ano = $calendario->ano;
            $estacao = $calendario->estacao;

            if (!array_key_exists($ano, $anosEstacoes)) {
                $anosEstacoes[$ano] = [];
            }

            $anosEstacoes[$ano][] = $estacao;
        }

        //dd($anosEstacoes);

        if($calendarios != NULL){

            return view('calendarios.ano', ['calendariosPorAno'=>$anosEstacoes]);

        }else{

            return redirect('/');

        }

    }


    public function show($anime){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar animes');
        }

        $anime_calendarios = Calendario::join('animes', 'anime_calendario.nome_anime', '=', 'animes.nome')
                            ->select('anime_calendario.*', 'animes.image', 'animes.sinopse', 'animes.dia_da_semana','animes.link')
                            ->where('link', $anime)
                            ->get();

        return view('calendarios.show', ['anime_calendarios'=>$anime_calendarios]);

    }

    public function edit($id){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $anime_calendario = Calendario::where('id', $id)->firstOrFail();

        return view('calendarios.edit', ['anime_calendario'=>$anime_calendario]);

    }

    public function update(Request $request,$id){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $data['estacao'] = $request->estacao;
        $data['ano'] = $request->ano;

        Calendario::where('id', $id)->firstOrFail()->update($data);

        return redirect()->back();

    }

    public function destroy($id){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        Calendario::where('id', $id)->firstOrFail()->delete();

        return redirect()->back();

    }

    public function create(){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        return view('calendarios.create');

    }

    public function store(Request $request){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $calendario = new Calendario;

        $calendario->nome_anime = $request->nome_anime;
        $calendario->estacao = $request->estacao;
        $calendario->ano = $request->ano;

        /*
        $caminhoimage = Calendario::join('animes', 'anime_calendario.nome_anime', '=', 'animes.nome')
                            ->select('anime_calendario.ano','anime_calendario.estacao', 'animes.image')
                            ->where('nome_anime', $request->nome_anime)
                            ->firstOrFail();

        $caminhoimage2 = Calendario::where('nome_anime',$request->nome_anime)->firstOrFail();

        $nomeimage = pathinfo($caminhoimage, PATHINFO_BASENAME);

        $source = public_path('img/calendario/'.$caminhoimage2->ano.'/'.$caminhoimage2->estacao.'/'.$nomeimage);

        $destination = public_path('img/calendario/'.$request->ano.'/'.$request->estacao);

        //dd($source . $destination);

        $destination = str_replace('\\', '/', public_path('img/calendario/'.$request->ano.'/'.$request->estacao));

        $source = str_replace('\\', '/', public_path('img/calendario/'.$caminhoimage2->ano.'/'.$caminhoimage2->estacao.'/'.$nomeimage));

        //dd($destination);

        Storage::makeDirectory($destination);

        Storage::move($source, $destination.'/'.$nomeimage);
        */

        $calendario->save();

        return redirect('/profile')->with('msg','Calendario Criado com sucesso!');

    }

}
