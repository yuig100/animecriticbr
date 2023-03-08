<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comentario;
use Carbon\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Analise;
use App\Models\GuiaDeTemporada;
use App\Models\Noticia;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersController extends Controller
{
    public function create(){

        return view('profile.registro');

    }

    public function edit($nickname){

        $user = User::where('nickname', $nickname)->firstOrFail();

        return view('profile.edit',['user'=>$user]);

    }

    public function store(UserRequest $request)
    {
        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $users = new User;

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Este e-mail já está sendo usado.']);
        }else{

            $users->email = $request->email;

        }

        $user = User::where('nickname', $request->nickname)->first();
        if($user){

            return redirect()->back()->withInput()->withErrors(['nickname' => 'Este Nick já está sendo usado.']);

        }else{

            $users->nickname = $request->nickname;

        }

        $users->nome = $request->nome;

        $users->password = bcrypt($request->password);

        $users->created_at = $currentDateTime;

        $users->tipo = 0;

        $users->image = 'default.jpg';

        $users->save();

        Auth::login($users);

        return redirect('/')->with('msg','Usuario criado com sucesso!');
    }

    public function index(){

        $user = auth()->user();

        if($user != Null){

            return redirect('/profile/'.$user->nickname);

        } else{

            return redirect('/register');

        }
    }

    public function show($nickname){

        $user = User::where('nickname', $nickname)->firstOrFail();

        //$comentario = Comentario::where('id_user', $id)->latest();

        $analises=Analise::where('id_user', $user->id)->latest()->get();
        $guiaDeTemporada=GuiadeTemporada::where('id_user', $user->id)->latest()->get();
        $noticias=Noticia::where('id_user', $user->id)->latest()->get();

        // Combina os resultados em uma única coleção
        $posts = collect();

        if ($noticias->isNotEmpty()) {
            foreach ($noticias as $p) {
                $posts[] = [
                    'id' => $p->id,
                    'image' => $p->image,
                    'titulo' => $p->titulo,
                    'descricao' => $p->descricao,
                    'tags' => $p->tags,
                    'link' => $p->link,
                    'id_user' => $p->id_user,
                    'id_categoria' => $p->id_categoria,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at
                ];
            }
        }

        if ($guiaDeTemporada->isNotEmpty()) {
            foreach ($guiaDeTemporada as $p) {
                $posts[] = [
                    'id' => $p->id,
                    'image' => $p->image,
                    'titulo' => $p->titulo,
                    'descricao' => $p->descricao,
                    'tags' => $p->tags,
                    'link' => $p->link,
                    'id_user' => $p->id_user,
                    'id_categoria' => $p->id_categoria,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'estacao' => $p->estacao,
                    'ano' => $p->ano,
                ];
            }
        }

        if ($analises->isNotEmpty()) {
            foreach ($analises as $p) {
                $posts[] = [
                    'id' => $p->id,
                    'image' => $p->image,
                    'titulo' => $p->titulo,
                    'descricao' => $p->descricao,
                    'anime' => $p->anime,
                    'link' => $p->link,
                    'id_user' => $p->id_user,
                    'id_categoria' => $p->id_categoria,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'episodio' => $p->episodio,
                ];
            }
        }

        $posts = collect($posts)->sortByDesc('created_at')->map(function($post) {
            return (object) $post;
        });

        $contpost = $posts->count();

        return view('profile.show',['user' => $user,'posts' => $posts,'contpost' =>$contpost]);

    }

    public function login(){

        return view('profile.login');

    }

    public function storelogin(Request $request){

        $request->validate([
        'username_email' => 'required|string',
        'password' => 'required|string',
        ]);

        $username_email = $request->input('username_email');
        $password = $request->input('password');

        // Check if the input is a valid email
        if (filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $username_email)->first();
        } else {
            $user = User::where('nickname', $username_email)->first();
        }

        // Verify user credentials
        if (!$user || !Hash::check($password, $user->password)) {
            return back()->withInput()->withErrors(['username_email' => 'Invalid login credentials']);
        }

        // Log the user in
        Auth::login($user);

        // Redirect to the intended page after login
        return redirect()->intended('/');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function update(Request $request){

        $usuario = Auth::user();

        if ($request->has('nome') && $request->nome != $usuario->nome) {
            $usuario->nome = $request->nome;
        }

        if ($request->has('bio') && $request->bio != $usuario->bio) {
            $usuario->bio = $request->bio;
        }

        if ($request->has('localizacao') && $request->localizacao != $usuario->localizacao) {
            $usuario->localizacao = $request->localizacao;
        }

        if ($request->has('genero') && $request->genero != $usuario->genero) {
            $usuario->genero = $request->genero;
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){

                $requestImage = $request->file('image');

                $extension = $requestImage->extension();

                $imageName=md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

                $destinationPath = public_path('img/users');

                $requestImage->move($destinationPath,$imageName);

                $data['image'] = $imageName;
                $usuario->image = $imageName;

        }

        $usuario->save();

        return redirect('/profile/'.$usuario->nickname);

    }

}
