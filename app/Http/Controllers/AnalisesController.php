<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Analise;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnalisesController extends Controller
{

    public function create()
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar analises');
        }

        $pagnome="Análises";
        $pagrota="analises";

        return view('posts.create',['pagnome' => $pagnome,'pagrota' => $pagrota]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar analises');
        }

        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $analises = new Analise;
        $analises->titulo = $request->titulo;
        $analises->descricao = $request->descricao;
        $analises->anime = $request->anime;
        $analises->episodio = $request->episodio;
        $analises->id_user = auth()->user()->id;
        $analises->created_at = $currentDateTime;
        $analises->updated_at = $currentDateTime;

        $categoria = Categoria::where('nome', 'Analise')->first();
        $analises->id_categoria = $categoria->id;

        /**/

        $analises->link = str_replace(" ", "-", $request->anime).'/'.$request->episodio;

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->file('image');

            $extension = $requestImage->extension();

            $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $destinationPath = public_path('img/analises');

            $requestImage->move($destinationPath,$imageName);

            $analises->image = $imageName;

        }

        $analises->save();

        return redirect('/analises')->with('msg','Analise Criada com sucesso!');
    }

    public function index(){

        $posts = Analise::latest()->paginate(12);

        $pagnome="Análises";
        $pagrota="analises";

        return view('posts.index',['posts' => $posts,'pagnome' => $pagnome,'pagrota' => $pagrota]);

    }

    public function show($anime, $episodio) {

        $anime = str_replace(" ", "-", $anime);

        $text = $anime.'/'.$episodio;

        $post = Analise::where('link', $text)->firstOrFail();

        $pagnome="Análises";
        $pagrota="analises";

        return view('posts.show', ['post' => $post,'pagrota' => $pagrota]);

    }

    public function edit($anime, $episodio){
        $user = Auth::user();

        $anime = str_replace(" ", "-", $anime);

        $text = $anime.'/'.$episodio;

        $post = Analise::where('link', $text)->firstOrFail();

        if(auth()->user()->id != $post->id_user){

            return redirect('/profile');

        }

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar analises');
        }

        $pagnome="Análises";
        $pagrota="analises";
        $categorias = Categoria::all();

        return view('posts.edit',['categorias' => $categorias,'post' => $post,'pagnome' => $pagnome,'pagrota' => $pagrota]);

    }

    public function update(Request $request,$anime, $episodio){
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $currentDateTime = Carbon::now('America/Sao_Paulo');

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $requestImage->move(public_path('img/noticias'),$imageName);

            $data['image'] = $imageName;

        }

        $data['titulo'] = $request->titulo;
        $data['descricao'] = $request->descricao;
        $data['anime'] = $request->anime;
        $data['episodio'] = $request->episodio;
        $data['id_categoria'] = $request->categoria;
        $data['updated_at'] = $currentDateTime;


        $anime = str_replace(" ", "-", $anime);

        $text = $anime.'/'.$episodio;

        Analise::where('link', $text)->firstOrFail()->update($data);

        return redirect('/profile')->with('msg','Analise editada com sucesso!');


    }

    public function destroy($anime, $episodio){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar analises');
        }

        $anime = str_replace(" ", "-", $anime);

        $text = $anime.'/'.$episodio;

        Analise::where('link', $text)->firstOrFail()->delete();

    }

}
