<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Noticia;
use App\Models\Analise;
use App\Models\GuiaDeTemporada;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index(){

        //
        $noticias = Noticia::all()->reverse()->take(8);

        $analises = Analise::all()->reverse()->take(8);

        //
        $oneguia = GuiaDeTemporada::latest()->first();

        //
        $categoria = Categoria::where('nome', 'Ranking de Venda')->first();

        $id_categoria = $categoria->id;

        $onerankvendas = Noticia::where('id_categoria', $id_categoria)->latest()->first();

        //
        $categoria = Categoria::where('nome', 'Ranking Japonês')->first();

        $id_categoria = $categoria->id;

        $onerankJP = Noticia::where('id_categoria', $id_categoria)->latest()->first();

        //
        $categoria = Categoria::where('nome', 'Ranking BR')->first();

        $id_categoria = $categoria->id;

        $onerankBR = Noticia::where('id_categoria', $id_categoria)->latest()->first();

        //

        return view('home',['noticias' => $noticias,'analises' => $analises,'oneguia'=>$oneguia,'onerankvendas'=>$onerankvendas,'onerankJP'=>$onerankJP,'onerankBR'=>$onerankBR]);

    }

}
