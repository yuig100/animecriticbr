<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Carbon\Carbon;
use App\Models\GuiadeTemporada;
use Illuminate\Support\Facades\Auth;

class GuiadeTemporadaController extends Controller
{

    public function create()
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar guias');
        }

        $pagnome="Guias de Temporada";
        $pagrota="guia-de-temporada";



        return view('posts.create',['pagnome' => $pagnome,'pagrota' => $pagrota]);
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar guias');
        }

        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $categoria = Categoria::where('nome', 'Guia de Temporada')->first();

        $guiadetemporada = new GuiadeTemporada;
        $guiadetemporada->titulo = $request->titulo;
        $guiadetemporada->descricao = $request->descricao;
        $guiadetemporada->tags = $request->tags;
        $guiadetemporada->estacao = $request->estacao;
        $guiadetemporada->ano = $request->ano;
        $guiadetemporada->id_user = auth()->user()->id;
        $guiadetemporada->created_at = $currentDateTime;
        $guiadetemporada->updated_at = $currentDateTime;
        $guiadetemporada->id_categoria = $categoria->id;

        /**/

        $link = str_replace(" ", "-", $request->titulo);

        $text = $request->ano.'/'.$request->estacao.'/'.$link;

        $guiadetemporada->link = $text;


        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->file('image');

            $extension = $requestImage->extension();

            $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $destinationPath = public_path('img/guiadetemporada');

            $requestImage->move($destinationPath,$imageName);

            $guiadetemporada->image = $imageName;

        }

        $guiadetemporada->save();

        return redirect('/guia-de-temporada')->with('msg','Guia de Temporada criado com sucesso!');
    }

    public function index(){

        $pagnome="Guias de Temporada";
        $pagrota="guia-de-temporada";

        $posts = GuiadeTemporada::latest()->paginate(12);

        return view('posts.index',['posts' => $posts,'pagnome' => $pagnome,'pagrota' => $pagrota]);

    }

    public function show($ano,$estacao,$link){

        $pagnome="Guias de Temporada";
        $pagrota="guia-de-temporada";

        $text = $ano.'/'.$estacao.'/'.$link;

        $guiadetemporada = GuiadeTemporada::where('link', $text)->firstOrFail();

        return view('posts.show', ['post'=>$guiadetemporada,'pagrota'=>$pagrota]);

    }

    public function edit($ano,$estacao,$link){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $pagnome="Guias de Temporada";
        $pagrota="guia-de-temporada";

        $text = $ano.'/'.$estacao.'/'.$link;

        $post = GuiadeTemporada::where('link', $text)->firstOrFail();

        $categorias = Categoria::all();

        if(auth()->user()->id != $post->id_user){

            return redirect('/profile');

        }

        return view('posts.edit',['categorias' => $categorias,'post' => $post,'pagnome' => $pagnome,'pagrota' => $pagrota]);

    }

    public function update(Request $request,$ano,$estacao,$link){

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
        $data['tags'] = $request->tags;
        $data['id_categoria'] = $request->categoria;
        $data['updated_at'] = $currentDateTime;

        $text = $ano.'/'.$estacao.'/'.$link;

        GuiadeTemporada::where('link', $text)->firstOrFail()->update($data);

        return redirect('/profile')->with('msg','Noticia editada com sucesso!');

    }

    public function destroy($ano,$estacao,$link){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para destruir as noticias');
        }

        $text = $ano.'/'.$estacao.'/'.$link;

        GuiadeTemporada::where('link', $text)->firstOrFail()->delete();

        return redirect('/profile')->with('msg','Noticia excluida com sucesso!');

    }


}
