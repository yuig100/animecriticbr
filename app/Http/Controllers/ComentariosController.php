<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

class ComentariosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string',
            'id_publicacao' => 'required|integer',
            'publicacao_type' => 'required|string|max:255',
            'id_parent' => 'nullable|integer|exists:comentarios,id',
        ]);

        $comentario = Comentario::create([
            'comentario' => $request->comentario,
            'id_user' => Auth::user()->id,
            'id_publicacao' => $request->id_publicacao,
            'id_parent' => $request->id_parent,
            'publicacao_type' => $request->publicacao_type,
        ]);

        return back()->with('success', 'Comentário adicionado com sucesso!');
    }

    public function upvote(Comentario $comentario)
    {
        $comentario->increment('up_votos');

        return back();
    }

    public function downvote(Comentario $comentario)
    {
        $comentario->increment('down_votos');

        return back();
    }

    public function toggleVisibility(Comentario $comentario)
    {
        $comentario->update([
            'visivel' => !$comentario->visivel,
        ]);

        return back();
    }
}
