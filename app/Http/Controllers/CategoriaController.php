<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{

    public function index()
    {

        $categorias = Categoria::all();

        //dd($categorias);

        return view('categorias.index',['categorias'=>$categorias]);

    }


    public function create()
    {

        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar categorias');
        }

        return view('categorias.create');

    }


    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar categorias');
        }

        $categorias = new Categoria;

        $categorias->nome = $request->nome;
        $categorias->descrição = $request->descricao;

        $categorias->save();

        return redirect()->back();

    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para deletar');
        }

        $categoria = Categoria::where('id',$id)->firstOrFail();

        //dd($categoria);

        return view('categorias.edit',['categoria'=>$categoria]);

    }


    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar noticias');
        }

        $categorias = new Categoria;

        $data['nome'] = $request->nome;
        $data['descrição'] = $request->descricao;

        Categoria::where('id', $id)->firstOrFail()->update($data);

        return redirect()->back();

    }


    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->tipo < 2) {
            return redirect()->back()->with('error', 'Você não tem permissão para deletar');
        }

        Categoria::where('id', $id)->firstOrFail()->delete();
    }
}
