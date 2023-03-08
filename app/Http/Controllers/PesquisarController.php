<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Analise;
use App\Models\GuiaDeTemporada;
use App\Models\Noticia;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Pesquisar;
use App\Models\Anime;
use Illuminate\Support\Facades\DB;

class PesquisarController extends Controller
{
    public function pesquisar(Request $request)
    {
        $query = $request->input('query');

        // Busca categorias
        $categorias = Categoria::where(function ($q) use ($query) {
            $q->where('nome', 'LIKE', '%' . $query . '%')
              ->orWhere('descrição', 'LIKE', '%' . $query . '%');
        })->get();

        $categoriaIds = $categorias->pluck('id')->toArray();

        // Busca usuários
        $users = User::where('nome', 'LIKE', '%' . $query . '%')->get();

        $userIds = $users->pluck('id')->toArray();

        // Busca nas tabelas com as categorias e usuários relacionados
        $noticias = Noticia::where(function ($q) use ($query, $categoriaIds, $userIds) {
            $q->where('titulo', 'LIKE', '%' . $query . '%')
              ->orWhere('descricao', 'LIKE', '%' . $query . '%')
              ->orWhere('tags', 'LIKE', '%' . $query . '%')
              ->whereIn('id_categoria', $categoriaIds)
              ->whereIn('id_user', $userIds);
        })->latest()->paginate(12);

        $guiaDeTemporada = GuiaDeTemporada::where(function ($q) use ($query, $categoriaIds, $userIds) {
            $q->where('titulo', 'LIKE', '%' . $query . '%')
              ->orWhere('descricao', 'LIKE', '%' . $query . '%')
              ->orWhere('tags', 'LIKE', '%' . $query . '%')
              ->whereIn('id_categoria', $categoriaIds)
              ->whereIn('id_user', $userIds);
        })->latest()->paginate(12);

        $analises = Analise::where(function ($q) use ($query, $categoriaIds, $userIds) {
            $q->where('titulo', 'LIKE', '%' . $query . '%')
              ->orWhere('descricao', 'LIKE', '%' . $query . '%')
              ->orWhere('anime', 'LIKE', '%' . $query . '%')
              ->whereIn('id_categoria', $categoriaIds)
              ->whereIn('id_user', $userIds);
        })->latest()->paginate(12);



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
                    'id_user' => $p->id_user,
                    'id_categoria' => $p->id_categoria,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'episodio' => $p->episodio,
                ];
            }
        }

        //dd($posts);

        $posts = collect($posts)->sortByDesc('created_at')->map(function($post) {
            return (object) $post;
        });

        if ($posts->isNotEmpty()) {
            // Cria a instancia do paginador com os resultados mesclados
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 12;
            $currentPageSearchResults = $posts->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $posts = new LengthAwarePaginator($currentPageSearchResults, $posts->count(), $perPage);
            $posts->appends(['query' => $query]);
            return view('posts.search', ['posts' => $posts,'categoriaIds'=>$categoriaIds,'userIds'=>$userIds]);
        } else {
            return view('posts.search')->with('msg','Não foi encontrado nada!');
        }
    }

    public function pesquisarCategoria(Request $request){

        $query = $request->input('query');

        $categorias = Categoria::where('nome', $query)->first();

        $categoriasid = $categorias->id;

        if($categoriasid == 2){
            $posts = Analise::where('id_categoria', $categoriasid)->latest()->paginate(12);
        }elseif($categoriasid == 3){
            $posts = GuiaDeTemporada::where('id_categoria', $categoriasid)->latest()->paginate(12);
        }else{
            $posts = Noticia::where('id_categoria', $categoriasid)->latest()->paginate(12);
        }

        $posts->appends(['query' => $query]);

        return view('posts.search', ['posts' => $posts, 'categoriasid' => $categoriasid]);
    }

    public function pesquisarTags(Request $request){

        $query = $request->input('query');

        $noticias = Noticia::where('tags', $query)->latest()->paginate(12);

        $guiaDeTemporada = GuiaDeTemporada::where('tags', $query)->latest()->paginate(12);

        $analises = Analise::where('anime', $query)->latest()->paginate(12);

        $posts = collect();

        if ($noticias->isNotEmpty()) {
            foreach ($noticias as $p) {
                $posts[] = [
                    'id' => $p->id,
                    'image' => $p->image,
                    'titulo' => $p->titulo,
                    'descricao' => $p->descricao,
                    'tags' => $p->tags,
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
                    'id_user' => $p->id_user,
                    'id_categoria' => $p->id_categoria,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'episodio' => $p->episodio,
                ];
            }
        }

        //dd($posts);

        $posts = collect($posts)->sortByDesc('created_at')->map(function($post) {
            return (object) $post;
        });

        if ($posts->isNotEmpty()) {
            // Cria a instancia do paginador com os resultados mesclados
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 12;
            $currentPageSearchResults = $posts->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $posts = new LengthAwarePaginator($currentPageSearchResults, $posts->count(), $perPage);
            $posts->appends(['query' => $query]);
            return view('posts.search', ['posts' => $posts,'categoriaIds'=>$categoriaIds,'userIds'=>$userIds]);
        } else {
            return redirect('/search')->with('msg','Não foi encontrado nada!');
        }

    }

    public function pesquisarAnimes(Request $request){

        $query = $request->input('query');

        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $animes = Anime::join('anime_calendario', 'animes.nome', '=', 'anime_calendario.nome_anime')
                  ->select('animes.*', 'anime_calendario.ano', 'anime_calendario.estacao')
                  ->where('nome', 'LIKE', '%' . $query . '%')
                  ->groupBy('animes.id')
                  ->orderBy('animes.nome')
                  ->paginate(12);

        if ($animes->isNotEmpty()) {
            return view('animes.index',['animes'=>$animes]);
        } else{
            return view('animes.index')->with('msg','Não foi encontrado nada!');
        }

    }

}
