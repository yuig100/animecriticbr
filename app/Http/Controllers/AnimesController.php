<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Analise;
use App\Models\Anime;
use App\Models\Calendario;
use Illuminate\Support\Facades\DB;


class AnimesController extends Controller
{
    public function index(){

        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $animes = Anime::select('animes.*', 'anime_calendario.ano', 'anime_calendario.estacao')
            ->join('anime_calendario', 'animes.nome', '=', 'anime_calendario.nome_anime')
            ->groupBy('animes.id')
            ->orderBy('animes.nome')
            ->paginate(12);

        //dd($animes);

        return view('animes.index',['animes'=>$animes]);
    }

    public function create(){
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar animes');
        }

        return view('animes.create');

    }

    public function store(Request $request){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar animes');
        }

        $animes = new Anime;
        $calendario = new Calendario;

        $animes->nome = $request->nome;
        $animes->sinopse = $request->sinopse;
        $animes->dia_da_semana = $request->dia_da_semana;

        $calendario->nome_anime = $request->nome;
        $calendario->estacao = $request->estacao;
        $calendario->ano = $request->ano;

        $link = str_replace(" ", "-", $request->nome);
        $animes->link = $link;

        $ano = $request->ano;
        $estacao = $request->estacao;

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->file('image');

            $extension = $requestImage->extension();

            $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $destinationPath = public_path('img/calendario/'.$ano.'/'.$estacao);

            $requestImage->move($destinationPath,$imageName);

            $animes->image = $imageName;

        }

        $animes->save();
        $calendario->save();

        return redirect('/profile')->with('msg','Anime Criado com sucesso!');

    }

    public function show($anime){

        $animes = Anime::join('anime_calendario','animes.nome','=','anime_calendario.nome_anime')->select('animes.*','anime_calendario.estacao','anime_calendario.ano')
            ->where('link', $anime)
            ->firstOrFail();

        $reviews = Analise::where('anime', $animes->nome)->orderBy('episodio')->get();

        return view('animes.show', ['animes' => $animes,'reviews'=>$reviews]);

    }

    public function edit($anime){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar animes');
        }

        $animes = Anime::where('link', $anime)->firstOrFail();

        return view('animes.edit',['animes' => $animes]);

    }

    public function update(Request $request,$anime){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar animes');
        }

        $animes = Anime::where('link', $anime)->firstOrFail();

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $destinationPath = public_path('img/calendario/'.$animes->ano.'/'.$animes->estacao);

            $requestImage->move($destinationPath,$imageName);

            $data['image'] = $imageName;

        }

        $data['nome'] = $request->nome;
        $data['sinopse'] = $request->sinopse;
        $data['dia_da_semana'] = $request->dia_da_semana;

        if($data['nome'] != $animes->nome){
            $data['link'] = str_replace(" ", "-", $request->nome);
        }

        Anime::where('link', $anime)->firstOrFail()->update($data);

    }

    public function destroy($anime){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para destruir as noticias');
        }

        Anime::where('link', $anime)->firstOrFail()->delete();

        return redirect('/profile')->with('msg','Anime excluido com sucesso!');


    }

}
