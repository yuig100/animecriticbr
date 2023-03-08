<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Categoria;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;
use DateTime;

class NoticiasController extends Controller{

    /*Vai para a pagina de criar as noticias*/
    public function create()
    {

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $pagnome="Notícias";
        $pagrota="noticias";
        $categorias = Categoria::all();
        return view('posts.create',['categorias' => $categorias,'pagnome' => $pagnome,'pagrota' => $pagrota]);
    }

    /*Cria as Noticias*/
    public function store(Request $request)
    {

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $noticias = new Noticia;
        $noticias->titulo = $request->titulo;
        $noticias->descricao = $request->descricao;
        $noticias->tags = $request->tags;
        $noticias->id_user = auth()->user()->id;
        $noticias->id_categoria = $request->categoria;
        $noticias->created_at = $currentDateTime;
        $noticias->updated_at = $currentDateTime;

        /**/
        $link = str_replace(" ", "-", $request->titulo);
        $ano = date('Y',strtotime($currentDateTime));
        $mes = date('m',strtotime($currentDateTime));
        $dia = date('d',strtotime($currentDateTime));

        $noticias->link = $ano.'/'.$mes.'/'.$dia.'/'.$link;

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->file('image');

            $extension = $requestImage->extension();

            $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $destinationPath = public_path('img/noticias');

            $requestImage->move($destinationPath,$imageName);

            $noticias->image = $imageName;

        }

        $noticias->save();

        return redirect('/noticias')->with('msg','Noticia Criada com sucesso!');
    }

    /*Mostra uma Pagina com todas as noticias*/
    public function index()
    {

        $pagnome="Notícias";
        $pagrota="noticias";


        $posts = Noticia::latest()->paginate(12);

        return view('posts.index',['posts' => $posts,'pagnome' => $pagnome,'pagrota' => $pagrota]);

    }

    /*Mostra a pagina de uma noticia em especifico*/
    public function show($ano,$mes,$dia,$link){

        $text = $ano.'/'.$mes.'/'.$dia.'/'.$link;

        $post = Noticia::where('link', $text)->firstOrFail();

        $pagnome="Notícias";
        $pagrota="noticias";

        return view('posts.show',['post' => $post,'pagrota' => $pagrota]);

    }

    /*Vai para a pagina de editar noticias*/
    public function edit($ano,$mes,$dia,$link){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $text = $ano.'/'.$mes.'/'.$dia.'/'.$link;

        $pagnome="Notícias";
        $pagrota="noticias";
        $post = Noticia::where('link', $text)->firstOrFail();
        $categorias = Categoria::all();

        if(auth()->user()->id != $post->id_user){

            return redirect('/profile');

        }

        return view('posts.edit',['categorias' => $categorias,'post' => $post,'pagnome' => $pagnome,'pagrota' => $pagrota]);

    }

    /*Faz a modificação da noticia*/
    public function update(Request $request,$ano,$mes,$dia,$link){

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $text = $ano.'/'.$mes.'/'.$dia.'/'.$link;

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
        Noticia::where('link', $text)->firstOrFail()->update($data);

        return redirect('/noticias/'.$text)->with('msg','Noticia editada com sucesso!');

    }

    /*Deleta a noticia*/
    public function destroy($ano,$mes,$dia,$link){

        $user = Auth::user();

        $text = $ano.'/'.$mes.'/'.$dia.'/'.$link;

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para destruir as noticias');
        }

        Noticia::where('link', $text)->firstOrFail()->delete();

        return redirect('/profile')->with('msg','Noticia excluida com sucesso!');

    }

}
