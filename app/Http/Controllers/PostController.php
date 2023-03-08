<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Services\OpenAIRequest;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        // Obter a notícia e gerar o texto com a IA
        $noticia = $request->noticia; // substitua "noticia" pelo nome do campo que contém a notícia no formulário
        $prompt = "Gerar um texto com base na notícia: {$noticia}.";
        $result = OpenAI::completion()->model('text-davinci-002')->prompt($prompt)->generate();
        $texto = $result->choices[0]->text;

        // Obter a tag com base na notícia
        $tag = strtolower(str_replace(' ', '-', $noticia));

        // Obter a imagem do post (supondo que a notícia tenha uma imagem)
        $image = $request->imagem; // substitua "imagem" pelo nome do campo que contém a imagem no formulário

        // Criar o post
        $post = new Noticia;
        $post->titulo = $noticia;
        $post->descricao = $texto;
        $post->tags = $tag;
        $post->image = $image;
        $post->id_user = 1; // substitua 1 pelo ID do usuário que criou o post
        $post->id_categoria = 1; // substitua 1 pelo ID da categoria do post
        $post->save();

        return redirect()->back()->with('success', 'Post criado com sucesso!');
    }
}
